<?php

namespace CrpTecnologia\CieloClient;

use CrpTecnologia\CieloClient\Auth\Credentials;
use CrpTecnologia\CieloClient\Auth\Token;
use GuzzleHttp\Client;

/**
 * Class AuthService
 * @package CrpTecnologia\CieloClient
 * @internal
 */
class AuthService
{
    public const AUTH_TOKEN_ENDPOINT = '/oauth2/token';

    /**
     * @var Token
     */
    private $token;
    /**
     * @var Credentials
     */
    private $credentials;
    /**
     * @var Client
     */
    private $httpAuth;

    public function __construct(Credentials $credentials, Client $httpAuth)
    {
        $this->credentials = $credentials;
        $this->httpAuth = $httpAuth;
    }

    public function fetchToken(): Token
    {
        if ($this->hasToken()) {
            return $this->token;
        }

        $response = $this->httpAuth->post(self::AUTH_TOKEN_ENDPOINT, [
            'headers' => [
                'Authorization' => "Basic $this->credentials",
                'Content-Type' => 'application/x-www-form-urlencoded'
            ],
            'form_params' => [
                'grant_type' => 'client_credentials'
            ]
        ]);

        $data = json_decode($response->getBody()->getContents(), true);

        $this->token = new Token($data->access_token, $data->expires_in);

        return $this->token;
    }

    private function hasToken(): bool
    {
        return $this->token !== null &&
            $this->token->isNotExpired();
    }

}
