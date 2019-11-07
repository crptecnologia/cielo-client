<?php

namespace CrpTecnologia\CieloClient;

use CrpTecnologia\CieloClient\TokenizationCard\CardTokenizationRequest;
use GuzzleHttp\Client;

class CardTokenizationService
{
    public const CARD_TOKEN_ENDPOINT = '/1/card/';
    /**
     * @var Client
     */
    private $httpCommence;
    private $headers;

    public function __construct(Client $httpCommence, $headers)
    {
        $this->httpCommence = $httpCommence;
        $this->headers = $headers;
    }

    public function cardTokenization(CardTokenizationRequest $cardTokenizationRequest): string
    {
        $response = $this->httpCommence->post(self::CARD_TOKEN_ENDPOINT, [
            'headers' => $this->headers,
            'json' => $cardTokenizationRequest,
        ]);

        $data = json_decode($response->getBody()->getContents());

        return $data->CardToken;
    }
}
