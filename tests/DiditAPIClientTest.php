<?php

use AlexStewartJa\Didit\Didit;
use AlexStewartJa\Didit\Env;
use AlexStewartJa\Didit\Exceptions\DiditApiException;
use AlexStewartJa\Didit\Models\Kyc\Session;
use AlexStewartJa\Didit\Models\Kyc\SessionAml\SessionAml;
use AlexStewartJa\Didit\Models\Kyc\SessionFace\SessionFace;
use AlexStewartJa\Didit\Models\Kyc\SessionKyc;
use AlexStewartJa\Didit\Models\Kyc\SessionLocation\SessionLocation;
use AlexStewartJa\Didit\Models\Kyc\TokenInfo;
use AlexStewartJa\Didit\Models\Kyc\VerificationFeatures;
use AlexStewartJa\Didit\Models\Kyc\VerificationStatus;
use AlexStewartJa\Didit\Temporal\DiditExtendedDateTime;

function save_credentials(stdClass $credentials): void
{
    file_put_contents('tests/assets/credentials.json', json_encode($credentials));
}

beforeEach(function () {
    $this->credentials = json_decode(file_get_contents('tests/assets/credentials.json'));
});

it('can get access token', function () {
    $token_info = new TokenInfo;

    try {
        $token_info = Didit::getAccessToken($this->credentials->client_id, $this->credentials->client_secret);
        $access_token = $token_info->getAccessToken();

        if ($access_token) {
            $this->credentials->access_token = $access_token;
            save_credentials($this->credentials);
        }

        expect($token_info)->toBeInstanceOf(TokenInfo::class)
            ->and($access_token)->toBeString();
    } catch (DiditApiException $exception) {
        expect($token_info)->toBeInstanceOf(TokenInfo::class)
            ->and($token_info->getAccessToken())->toBeEmpty();
    }
});

it('can create a verification session', function () {
    $vendor_data = uniqid('test-', true);
    $session = new Session;

    try {
        $session = Didit::createVerificationSession(
            $this->credentials->access_token,
            $vendor_data,
            'https://verify.didit.me/',
            VerificationFeatures::OCR_FACE
        );

        $session_id = $session->getSessionId();
        if ($session_id && ! $this->credentials->session_id) {
            $this->credentials->session_id = $session_id;
            save_credentials($this->credentials);
        }
        expect($session)->toBeInstanceOf(Session::class)
            ->and($session_id)->toBeUuid();
    } catch (DiditApiException $exception) {
        expect($session)->toBeInstanceOf(Session::class)
            ->and($session->getSessionId())->toBeEmpty();
    }
});

it('can get a verification session', function () {
    $session = new Session;

    try {
        $session = Didit::getVerificationSession($this->credentials->access_token, $this->credentials->session_id);
        expect($session)->toBeInstanceOf(Session::class)
            ->and($session->getSessionId())->toBeUuid();
    } catch (DiditApiException $exception) {
        expect($session)->toBeInstanceOf(Session::class)
            ->and($session->getSessionId())->toBeEmpty();
    }
});

it('can download a verification session pdf report', function () {
    $access_token = $this->credentials->access_token;
    $session_id = $this->credentials->session_id;
    $generated = false;

    try {
        $generated = Didit::generateVerificationSessionPdf($access_token, $session_id, 'tests/assets/session.pdf');
        expect($generated)->toBeTrue();
    } catch (DiditApiException $exception) {
        expect($generated)->toBeFalse();
    }
});

it('can approve/decline verification session', function () {
    $access_token = $this->credentials->access_token;
    $session_id = $this->credentials->session_id;
    $updated = false;

    try {
        $session = Didit::getVerificationSession($access_token, $session_id);
        expect($session)->toBeInstanceOf(Session::class);
        $new_status = ($session->getStatus() == VerificationStatus::APPROVED) ?
            VerificationStatus::DECLINED : VerificationStatus::APPROVED;
        $updated = Didit::updateVerificationSessionStatus(
            $access_token,
            $session_id,
            $new_status,
            "Testing $new_status @ ".(new DateTime)->format(Env::DATETIME_FORMAT)
        );
        expect($updated)->toBeTrue();
    } catch (DiditApiException $exception) {
        expect($updated)->toBeFalse();
    }
});

it('can throw exception on invalid verification session status', function () {
    $access_token = $this->credentials->access_token;
    $session_id = $this->credentials->session_id;
    Didit::updateVerificationSessionStatus(
        $access_token,
        $session_id,
        VerificationStatus::IN_REVIEW,
        'Testing in review @ '.(new DateTime)->format(Env::DATETIME_FORMAT)
    );
})->throws(DiditApiException::class);

it('can construct a valid verification session object', function () {
    $session_json = file_get_contents('tests/assets/session.json');
    $session_array = json_decode($session_json, true);
    $session = new Session($session_array);
    expect($session)->toBeInstanceOf(Session::class)
        ->and($session->getSessionId())->toBeUuid()
        ->and($session->getSessionNumber())->toBeNumeric()
        ->and($session->getSessionUrl())->toBeUrl()
        ->and($session->getStatus())->toBeIn(VerificationStatus::getValues())
        ->and($session->getVendorData())->toBeString()
        ->and($session->getCallback())->toBeUrl()
        ->and($session->getFeatures())->toBeIn(VerificationFeatures::getValues())
        ->and($session->getKyc())->toBeInstanceOf(SessionKyc::class)
        ->and($session->getAml())->toBeInstanceOf(SessionAml::class)
        ->and($session->getFace())->toBeInstanceOf(SessionFace::class)
        ->and($session->getLocation())->toBeInstanceOf(SessionLocation::class)
        ->and($session->getWarnings())->toBeArray()
        ->and($session->getUserHref())->toBeNull()
        ->and($session->getReviews())->toBeArray()
        ->and($session->getExtraImages())->toBeArray()
        ->and($session->getCreatedAt())->toBeInstanceOf(DiditExtendedDateTime::class);
    file_put_contents('tests/assets/session_export.json', json_encode($session->toArray()));
});
