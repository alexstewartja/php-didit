<?php

namespace AlexStewartJa\Didit\Helpers;

class WebhookHelper
{
    /**
     * Verify an incoming Didit webhook, in a safe way, guarding against timing attacks
     *
     * @param string $requestBody The raw (text) body of the incoming webhook request
     * @param string $signatureHeader The `X-Signature` header of the incoming webhook request
     * @param string $timestampHeader The `X-Timestamp` header of the incoming webhook request
     * @param string $webhookSecretKey The webhook secret key copied from the Didit dashboard
     *
     * @return bool `true` if webhook is valid/authentic, `false` otherwise
     *
     * @link https://docs.didit.me/identity-verification/webhooks Webhooks
     */
    public static function verifyWebhookSignature(string $requestBody, string $signatureHeader,
                                                  string $timestampHeader, string $webhookSecretKey): bool
    {
        if (abs(time() - (int)$timestampHeader) > 300) {
            return false;
        }

        return hash_equals($signatureHeader, hash_hmac('sha256', $requestBody, $webhookSecretKey));
    }
}
