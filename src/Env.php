<?php

namespace AlexStewartJa\Didit;

interface Env
{
    public const BASE_URL = 'https://apx.didit.me';

    public const VERIFICATION_BASE_URL = 'https://verification.didit.me';

    public const TOKEN_ENDPOINT = '/auth/v2/token/';

    public const V1_SESSION_ENDPOINT = '/v1/session/';

    public const V1_SESSION_DECISION_ENDPOINT = '/v1/session/{session_id}/decision/';

    public const V1_SESSION_PDF_ENDPOINT = '/v1/session/{session_id}/generate-pdf/';

    public const V1_SESSION_STATUS_ENDPOINT = '/v1/session/{session_id}/update-status/';

    public const DATETIME_FORMAT = 'Y-m-d\TH:i:s';

    public const EXTENDED_DATETIME_FORMAT = 'Y-m-d\TH:i:s.u\Z';
}
