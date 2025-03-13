<?php

namespace AlexStewartJa\Didit;

use AlexStewartJa\Didit\Exceptions\DiditApiException;
use AlexStewartJa\Didit\Exceptions\DiditException;
use AlexStewartJa\Didit\Models\Kyc\Session;
use AlexStewartJa\Didit\Models\Kyc\TokenInfo;
use AlexStewartJa\Didit\Models\Kyc\VerificationFeatures;
use AlexStewartJa\Didit\Models\Kyc\VerificationStatus;
use GuzzleHttp\Psr7\Request;
use Http\Adapter\Guzzle7\Client as GuzzleAdapter;
use Psr\Http\Message\StreamInterface;

class Didit
{
    /**
     * Get a Didit Access Token
     *
     * To interact with the Didit API, you need to authenticate using an `access_token`.
     * This token is required for all API requests to ensure secure access.
     *
     * @param  string  $client_id  Client ID of the Didit application
     * @param  string  $client_secret  Client Secret of the Didit application
     * @return TokenInfo|null Didit Access Token
     *
     * @throws DiditApiException
     *
     * @link https://docs.didit.me/identity-verification/api-reference/authentication#2-get-the-access_token Get the `access_token`
     */
    public static function getAccessToken(string $client_id, string $client_secret): ?TokenInfo
    {
        try {
            $response = self::getAdapter()->sendRequest(new Request(
                'POST',
                Env::BASE_URL.Env::TOKEN_ENDPOINT,
                [
                    'Content-Type' => 'application/x-www-form-urlencoded',
                    'Authorization' => 'Basic '.base64_encode($client_id.':'.$client_secret),
                ],
                http_build_query(['grant_type' => 'client_credentials'])
            ));

            $response_data = json_decode($response->getBody()->getContents(), true);

            if ($response->getStatusCode() === 200) {
                return new TokenInfo($response_data);
            }

            DiditApiException::throwExceptionFromResponse($response_data);
        } catch (\Throwable $exception) {
            DiditApiException::throwSessionApiException($exception->getMessage());
        }

        return null;
    }

    public static function getAdapter(): GuzzleAdapter
    {
        return GuzzleAdapter::createWithConfig(['timeout' => 5]);
    }

    /**
     * Create a Verification Session
     *
     * @param  string  $access_token  A Didit Access Token required for all API requests to ensure secure access.
     * @param  string  $vendor_data  Unique identifier or data for the vendor, typically the `uuid` of the user trying to verify.
     * @param  string  $callback  A URL for redirection post-verification.
     * @param  string|null  $features  Verification features to be used.
     * @return Session Created Didit Verification Session
     *
     * @throws DiditApiException
     *
     * @see VerificationFeatures
     * @link https://docs.didit.me/identity-verification/api-reference/create-session Creating a Verification Session
     */
    public static function createVerificationSession(string $access_token, string $vendor_data, string $callback, ?string $features = null): Session
    {
        try {
            $data = array_filter([
                'vendor_data' => $vendor_data,
                'callback' => $callback,
                'features' => $features,
            ], fn ($value) => $value !== null);

            $response = self::getAdapter()->sendRequest(new Request(
                'POST',
                Env::VERIFICATION_BASE_URL.Env::V1_SESSION_ENDPOINT,
                [
                    'Content-Type' => 'application/json',
                    'Authorization' => "Bearer $access_token",
                ],
                json_encode($data)
            ));

            $response_data = json_decode($response->getBody()->getContents(), true);

            if ($response->getStatusCode() === 201) {
                return new Session($response_data);
            }

            DiditApiException::throwExceptionFromResponse($response_data);
        } catch (\Throwable $exception) {
            DiditApiException::throwSessionApiException($exception->getMessage());
        }
    }

    /**
     * Get a Verification Session
     *
     * @param  string  $access_token  A Didit Access Token required for all API requests to ensure secure access.
     * @param  string  $session_id  ID of Verification Session to retrieve
     * @return Session Retrieved Didit Verification Session
     *
     * @throws DiditApiException
     *
     * @link https://docs.didit.me/identity-verification/api-reference/retrieve-session Retrieving a Verification Result
     */
    public static function getVerificationSession(string $access_token, string $session_id): Session
    {
        try {
            $response = self::getAdapter()->sendRequest(new Request(
                'GET',
                Env::VERIFICATION_BASE_URL.str_replace('{session_id}', $session_id, Env::V1_SESSION_DECISION_ENDPOINT),
                [
                    'Content-Type' => 'application/json',
                    'Authorization' => "Bearer $access_token",
                ]
            ));

            $response_data = json_decode($response->getBody()->getContents(), true);

            if ($response->getStatusCode() === 200) {
                return new Session($response_data);
            }

            DiditApiException::throwExceptionFromResponse($response_data);
        } catch (\Throwable $exception) {
            DiditApiException::throwSessionApiException($exception->getMessage());
        }
    }

    /**
     * Generate a Verification Session PDF
     *
     * You can only generate a PDF for sessions `In Review`, `Declined` or `Approved`
     *
     * @param  string  $access_token  A Didit Access Token required for all API requests to ensure secure access.
     * @param  string  $session_id  ID of Verification Session for which to generate PDF report.
     * @param  string|null  $save_to  Optional path to a file that will store the PDF data.
     * @return StreamInterface|bool `true` if file is saved successfully, streamable response if no `$save_to`
     *                              path is specified
     *
     * @throws DiditApiException
     *
     * @link https://docs.didit.me/identity-verification/api-reference/generate-pdf Generating a Verification PDF Report
     */
    public static function generateVerificationSessionPdf(string $access_token, string $session_id, ?string $save_to = null): StreamInterface|bool
    {
        try {
            $response = self::getAdapter()->sendRequest(new Request(
                'GET',
                Env::VERIFICATION_BASE_URL.str_replace('{session_id}', $session_id, Env::V1_SESSION_PDF_ENDPOINT),
                [
                    'Content-Type' => 'application/json',
                    'Authorization' => "Bearer $access_token",
                ]
            ));

            if ($response->getStatusCode() === 200) {
                if ($save_to !== null) {
                    return file_put_contents($save_to, $response->getBody()) !== false;
                }

                return $response->getBody();
            }

            DiditApiException::throwExceptionFromResponse(json_decode($response->getBody()->getContents(), true));
        } catch (\Throwable $exception) {
            DiditApiException::throwSessionApiException($exception->getMessage());
        }
    }

    /**
     * Update Verification Session Status
     *
     * @param  string  $access_token  A Didit Access Token required for all API requests to ensure secure access.
     * @param  string  $session_id  ID of Verification Session to retrieve
     * @param  string  $new_status  New status to update Verification Session to. It can be `Approved`, or `Declined`
     * @param  string|null  $comment  An optional comment to be added to the Session review
     * @return true if status update was successful
     *
     * @throws DiditApiException
     *
     * @link https://docs.didit.me/identity-verification/api-reference/update-status Updating a Verification Session Status
     * @see VerificationStatus
     */
    public static function updateVerificationSessionStatus(string $access_token, string $session_id, string $new_status, ?string $comment): bool
    {
        try {
            $valid_statuses = [VerificationStatus::APPROVED, VerificationStatus::DECLINED];

            if (! in_array($new_status, $valid_statuses)) {
                throw new DiditException('Invalid verification status. Accepted values are: '.implode(', ', $valid_statuses).'.');
            }

            $data = array_filter([
                'new_status' => $new_status,
                'comment' => $comment,
            ], fn ($value) => $value !== null);

            $response = self::getAdapter()->sendRequest(new Request(
                'PATCH',
                Env::VERIFICATION_BASE_URL.str_replace('{session_id}', $session_id, Env::V1_SESSION_STATUS_ENDPOINT),
                [
                    'Content-Type' => 'application/json',
                    'Authorization' => "Bearer $access_token",
                ],
                json_encode($data)
            ));

            $response_data = json_decode($response->getBody()->getContents(), true);

            if ($response->getStatusCode() === 200 && array_key_exists('session_id', $response_data) &&
                $response_data['session_id'] === $session_id) {
                return true;
            }

            DiditApiException::throwExceptionFromResponse($response_data);
        } catch (\Throwable $exception) {
            DiditApiException::throwSessionApiException($exception->getMessage());
        }
    }
}
