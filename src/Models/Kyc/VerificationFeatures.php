<?php

namespace AlexStewartJa\Didit\Models\Kyc;

use AlexStewartJa\Didit\Traits\Constable;

abstract class VerificationFeatures extends Constable
{
    public const OCR = 'OCR';

    public const OCR_NFC = 'OCR + NFC';

    public const OCR_AML = 'OCR + AML';

    public const OCR_NFC_AML = 'OCR + NFC + AML';

    public const OCR_FACE = 'OCR + FACE';

    public const OCR_NFC_FACE = 'OCR + NFC + FACE';

    public const OCR_FACE_AML = 'OCR + FACE + AML';

    public const OCR_NFC_FACE_AML = 'OCR + NFC + FACE + AML';
}
