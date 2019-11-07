<?php

namespace CrpTecnologia\CieloClient\Split\Response;

use DateTime;
use stdClass;

class PaymentResponse
{
    /**
     * @var string|null
     */
    public $paymentId;
    /**
     * @var string|null
     */
    public $transactionId;
    /**
     * @var string|null
     */
    public $proofOfSale;
    /**
     * @var string|null
     */
    public $authorizationCode;

    /**
     * @var DateTime|null
     */
    public $receivedDate;
    /**
     * @var int
     */
    public $status;
    /**
     * @var string|null
     */
    public $returnCode;
    /**
     * @var stdClass
     */
    public $data;
    /**
     * @var string
     */
    public $paymentResponseRawData;

    public function __construct(
        ?string $paymentId,
        ?string $transactionId,
        ?string $proofOfSale,
        ?string $authorizationCode,
        ?DateTime $receivedDate,
        int $status,
        ?string $returnCode,
        stdClass $data,
        string $paymentResponseRawData
    ) {
        $this->paymentId = $paymentId;
        $this->transactionId = $transactionId;
        $this->proofOfSale = $proofOfSale;
        $this->authorizationCode = $authorizationCode;
        $this->receivedDate = $receivedDate;
        $this->status = $status;
        $this->returnCode = $returnCode;
        $this->data = $data;
        $this->paymentResponseRawData = $paymentResponseRawData;
    }
}
