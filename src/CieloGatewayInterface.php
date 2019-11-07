<?php

namespace CrpTecnologia\CieloClient;

use CrpTecnologia\CieloClient\Split\Request\SplitRequest;
use CrpTecnologia\CieloClient\Split\Response\PaymentResponse;
use CrpTecnologia\CieloClient\TokenizationCard\CardTokenizationRequest;

interface CieloGatewayInterface
{
    /**
     * @param SplitRequest $splitRequest
     * @return PaymentResponse
     */
    public function split(SplitRequest $splitRequest): PaymentResponse;

    /**
     * @param CardTokenizationRequest $cardTokenizationRequest
     * @return string
     */
    public function cardTokenization(CardTokenizationRequest $cardTokenizationRequest): string;
}
