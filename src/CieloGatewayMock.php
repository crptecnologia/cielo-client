<?php

namespace CrpTecnologia\CieloClient;

use CrpTecnologia\CieloClient\Split\Request\SplitRequest;
use CrpTecnologia\CieloClient\Split\Response\PaymentResponse;
use CrpTecnologia\CieloClient\TokenizationCard\CardTokenizationRequest;
use Exception;

class CieloGatewayMock implements CieloGatewayInterface
{

    private $paymentResponseCallback;
    /**
     * @var callable|null
     */
    private $cardTokenizationCallback;

    public function __construct(callable $paymentResponseCallback, ?callable $cardTokenizationCallback = null)
    {
        $this->paymentResponseCallback = $paymentResponseCallback;
        $this->cardTokenizationCallback = $cardTokenizationCallback;
    }

    /**
     * @param SplitRequest $splitRequest
     * @return PaymentResponse
     */
    public function split(SplitRequest $splitRequest): PaymentResponse
    {
        $paymentResponseCallback = $this->paymentResponseCallback;
        return $paymentResponseCallback($splitRequest);
    }

    /**
     * @param CardTokenizationRequest $cardTokenizationRequest
     * @return string
     * @throws Exception
     */
    public function cardTokenization(CardTokenizationRequest $cardTokenizationRequest): string
    {
        if ($this->cardTokenizationCallback === null) {
            return random_bytes(32);
        }

        $cardTokenizationCallback = $this->cardTokenizationCallback;

        return $cardTokenizationCallback($cardTokenizationRequest);
    }

}
