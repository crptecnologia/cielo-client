<?php

namespace CrpTecnologia\CieloClient\Split\Request\FraudAnalysis;

class FraudAnalysis
{
    /**
     * @var string
     */
    public $sequence;
    /**
     * @var string
     */
    public $sequenceCriteria;
    /**
     * @var string
     */
    public $provider;
    /**
     * @var string
     */
    public $captureOnLowRisk;
    /**
     * @var string
     */
    public $voidONHigRisk;
    /**
     * @var string
     */
    public $address;
    /**
     * @var Browser
     */
    public $browser;
    /**
     * @var int
     */
    public $totalOrderAmount;
    /**
     * @var int
     */
    public $transactionAmount;
    /**
     * @var Cart
     */
    public $cart;
    /**
     * @var array
     */
    public $merchantDefinedFields;
    /**
     * @var string
     */
    private $shippingAddress;

    /**
     * FraudAnalysis constructor.
     * @param string $sequence
     * @param string $sequenceCriteria
     * @param string $provider
     * @param string $captureOnLowRisk
     * @param string $voidONHigRisk
     * @param string $shippingAddress
     * @param Browser $browser
     * @param Cart $cart
     * @param int $totalOrderAmount
     * @param MerchantDefinedField[] $merchantDefinedFields
     */
    public function __construct(
        string $sequence,
        string $sequenceCriteria,
        string $provider,
        string $captureOnLowRisk,
        string $voidONHigRisk,
        string $shippingAddress,
        Browser $browser,
        Cart $cart,
        int $totalOrderAmount,
        array $merchantDefinedFields
    ) {
        $this->sequence = $sequence;
        $this->sequenceCriteria = $sequenceCriteria;
        $this->provider = $provider;
        $this->captureOnLowRisk = $captureOnLowRisk;
        $this->voidONHigRisk = $voidONHigRisk;
        $this->browser = $browser;
        $this->totalOrderAmount = $totalOrderAmount;
        $this->transactionAmount = $totalOrderAmount;
        $this->cart = $cart;
        $this->merchantDefinedFields = $merchantDefinedFields;
        $this->shippingAddress = $shippingAddress;
    }
}
