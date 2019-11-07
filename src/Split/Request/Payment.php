<?php

namespace CrpTecnologia\CieloClient\Split\Request;

class Payment
{
    public const CREDIT_CARD = 'SplittedCreditCard';
    public const DEBIT_CARD = 'SplittedDebitCard';
    /**
     * @var int
     */
    public $amount;
    /**
     * @var int
     */
    public $installments;
    /**
     * @var string
     */
    public $type;
    /**
     * @var string
     */
    public $capture;
    /**
     * @var string
     */
    public $softDescriptor;
    /**
     * @var Card
     */
    public $card;

    public function __construct(
        int $amount,
        int $installments,
        string $type,
        string $capture,
        string $softDescriptor,
        Card $card
    ) {
        $this->amount = $amount;
        $this->installments = $installments;
        $this->type = $type;
        $this->capture = $capture;
        $this->softDescriptor = $softDescriptor;
        $this->card = $card;
    }
}
