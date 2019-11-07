<?php

namespace CrpTecnologia\CieloClient\Split\Request;

use CrpTecnologia\CieloClient\Split\Request\FraudAnalysis\FraudAnalysis;

class SplitRequest
{
    /**
     * @var string
     */
    public $orderId;
    /**
     * @var Payment
     */
    public $payment;
    /**
     * @var Customer
     */
    public $customer;
    /**
     * @var array
     */
    public $subordinateMerchants;
    /**
     * @var FraudAnalysis
     */
    public $fraudAnalysis;

    public function __construct(
        string $orderId,
        Payment $payment,
        Customer $customer,
        array $subordinateMerchants,
        FraudAnalysis $fraudAnalysis
    ) {
        $this->orderId = $orderId;
        $this->payment = $payment;
        $this->customer = $customer;
        $this->subordinateMerchants = $subordinateMerchants;
        $this->fraudAnalysis = $fraudAnalysis;
    }
}
