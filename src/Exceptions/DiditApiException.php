<?php

namespace AlexStewartJa\Didit\Exceptions;

class DiditApiException extends DiditException
{
    /**
     * @throws DiditApiException
     */
    public static function throwSessionApiException(string $message)
    {
        throw new self("Session API Error: $message");
    }

    /**
     * @throws DiditApiException
     */
    public static function throwExceptionFromResponse(mixed $response_data): void
    {
        $message = is_array($response_data) ? implode(', ', $response_data) : json_encode($response_data);
        throw new self($message);
    }
}
