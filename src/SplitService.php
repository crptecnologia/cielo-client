<?php

namespace CrpTecnologia\CieloClient;

use CrpTecnologia\CieloClient\Split\Request\SplitMapper;
use CrpTecnologia\CieloClient\Split\Response\PaymentResponse;
use DateTime;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Psr\Http\Message\ResponseInterface;

/**
 * Class Split
 * @package CrpTecnologia\CieloClient
 * @internal
 */
class SplitService
{
    public const SALES_ENDPOINT = '/1/sales/';

    /**
     * @var Client
     */
    private $httpCommence;
    /**
     * @var bool
     */
    private $isSandBox;
    /**
     * @var string
     */
    private $returnUrl;
    /**
     * @var array
     */
    private $headers;

    public function __construct(Client $httpCommence, array $headers, bool $isSandBox, string $returnUrl)
    {
        $this->httpCommence = $httpCommence;
        $this->isSandBox = $isSandBox;
        $this->returnUrl = $returnUrl;
        $this->headers = $headers;
    }

    /**
     * @param Split\Request\SplitRequest $split
     * @return PaymentResponse
     * @throws Exception|RequestException
     */
    public function split(
        Split\Request\SplitRequest $split
    ): PaymentResponse {
        $options = [
            'headers' => $this->headers,
            'json' => new SplitMapper(
                $split,
                $this->isSandBox,
                $this->returnUrl
            ),
        ];

        $response = $this->httpCommence->post(self::SALES_ENDPOINT, $options);

        return self::makeResponse($response);
    }

    /**
     * @param ResponseInterface $response
     * @return PaymentResponse
     * @throws Exception
     */
    private function makeResponse(ResponseInterface $response): PaymentResponse
    {
        $rawData = $response->getBody()->getContents();
        $data = json_decode($rawData, false);

        $payment = $data->Payment;

        $receivedDate = isset($payment->ReceivedDate) ? new DateTime($payment->ReceivedDate) : null;

        return new PaymentResponse(
            $payment->PaymentId ?? null,
            $payment->Tid ?? null,
            $payment->ProofOfSale ?? null,
            $payment->AuthorizationCode ?? null,
            $receivedDate,
            $payment->Status,
            $payment->ReturnCode ?? null,
            $data,
            $rawData
        );
    }

}
