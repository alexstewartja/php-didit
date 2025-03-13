<?php

namespace AlexStewartJa\Didit\Models\Kyc;

use AlexStewartJa\Didit\Traits\Constable;

abstract class VerificationStatus extends Constable
{
    public const NOT_STARTED = 'Not Started';

    public const IN_PROGRESS = 'In Progress';

    public const APPROVED = 'Approved';

    public const DECLINED = 'Declined';

    public const IN_REVIEW = 'In Review';

    public const EXPIRED = 'Expired';

    public const ABANDONED = 'Abandoned';

    public const KYC_EXPIRED = 'Kyc Expired';
}
