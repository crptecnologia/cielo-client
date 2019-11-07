<?php

namespace CrpTecnologia\CieloClient;

use CrpTecnologia\CieloClient\Auth\Credentials;
use CrpTecnologia\CieloClient\Split\Request\SplitRequest;
use CrpTecnologia\CieloClient\Split\Response\PaymentResponse;
use CrpTecnologia\CieloClient\TokenizationCard\CardTokenizationRequest;
use Exception;
use GuzzleHttp\Client;

class CieloGateway implements CieloGatewayInterface
{
    public const AUTH_TOKEN_ENDPOINT = '/oauth2/token';
    public const CARD_BIN_ENDPOINT = '/1/cardBin/';

    /**
     * @var Client
     */
    private $httpCommence;
    /**
     * @var Client
     */
    private $httpCommenceQuery;
    /**
     * @var Client
     */
    private $httpAuth;

    /**
     * @var Credentials
     */
    private $credentials;
    /**
     * @var string
     */
    private $returnUrl;
    /**
     * @var bool
     */
    private $isSandBox;
    /**
     * @var SplitService
     */
    private $splitService;
    /**
     * @var AuthService
     */
    private $authService;

    private $cardTokenizationService;

    public function __construct(
        Client $httpCommence,
        Client $httpCommenceQuery,
        Client $httpAuth,
        string $returnUrl,
        Credentials $credentials,
        bool $isSandBox = true
    ) {
        $this->httpCommence = $httpCommence;
        $this->httpCommenceQuery = $httpCommenceQuery;
        $this->httpAuth = $httpAuth;
        $this->credentials = $credentials;
        $this->returnUrl = $returnUrl;
        $this->isSandBox = $isSandBox;
    }

    /**
     * @param SplitRequest $splitRequest
     * @return Split\Response\PaymentResponse
     * @throws Exception
     */
    public function split(SplitRequest $splitRequest): PaymentResponse
    {
        return $this->getSplitService()
            ->split($splitRequest);
    }

    private function getSplitService(): SplitService
    {
        return $this->splitService ??
            $this->splitService = new SplitService(
                $this->httpCommence,
                $this->makeDefaultHeaders(),
                $this->isSandBox,
                $this->returnUrl
            );
    }

    private function makeDefaultHeaders(): array
    {
        return [
            'Authorization' => (string)$this->getAuthService()->fetchToken(),
            'Content-Type' => 'application/json'
        ];
    }

    private function getAuthService(): AuthService
    {
        return $this->authService ?? $this->authService = new AuthService(
            $this->credentials,
            $this->httpAuth
        );
    }

    public function cardTokenization(CardTokenizationRequest $cardTokenizationRequest): string
    {
        return $this->getCardTokenizationService()
            ->cardTokenization($cardTokenizationRequest);
    }

    private function getCardTokenizationService(): CardTokenizationService
    {
        return $this->cardTokenizationService ??
            $this->cardTokenizationService = new CardTokenizationService(
                $this->httpCommence,
                $this->makeDefaultHeaders()
            );
    }

    /**
     * @param Credentials $credentials
     */
    public function setCredentials(Credentials $credentials)
    {
        $this->credentials = $credentials;
    }
}
