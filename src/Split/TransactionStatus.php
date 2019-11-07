<?php

namespace CrpTecnologia\CieloClient\Split;

class TransactionStatus
{
    public const NOT_FINISHED = 0;
    public const AUTHORIZED = 1;
    public const PAYMENT_CONFIRMED = 2;
    public const DENIED = 3;
    public const VOIDED = 10;
    public const REFUNDED = 11;
    public const PENDING = 12;
    public const ABORTED = 13;
    public const SCHEDULED = 20;
}
