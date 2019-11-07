<?php

namespace CrpTecnologia\CieloClient\Split\Request;

use CrpTecnologia\CieloClient\Card\CardType;
use CrpTecnologia\CieloClient\Split\Request\FraudAnalysis\CartItem;
use JsonSerializable;

class SplitMapper implements JsonSerializable
{

    /**
     * @var SplitRequest
     */
    private $split;
    /**
     * @var bool
     */
    private $isSandbox;
    /**
     * @var string
     */
    private $returnUrl;

    public function __construct(SplitRequest $split, bool $isSandbox, string $returnUrl)
    {
        $this->split = $split;
        $this->isSandbox = $isSandbox;
        $this->returnUrl = $returnUrl;
    }

    public function jsonSerialize(): array
    {
        return [
            'MerchantOrderId' => $this->split->orderId,
            'Customer' => $this->makeCustomer(),
            'Payment' => $this->makePayment()
        ];
    }

    /**
     * Ao realizar requisicao de pagamento para o ambiente sandbox da Cielo, necessario concatenar a palavra 'accept' ao
     * nome do comprador. Por favor, nao remover.
     */
    private function makeCustomer(): array
    {
        $customer = $this->split->customer;

        $name = $customer->name . ($this->isSandbox ? ' accept' : '');

        return [
            'Name' => $name,
            'Email' => $customer->email,
            'Identity' => $customer->cpf,
            'IdentityType' => 'CPF',
            'Mobile' => $customer->cellPhone,
            'DeliveryAddress' => $this->makeCustomerAddress(),
        ];
    }

    private function makeCustomerAddress(): array
    {
        $addressDTO = $this->split->customer->address;

        return [
            'Street' => $addressDTO->street,
            'District' => $addressDTO->district,
            'Complement' => $addressDTO->complement,
            'ZipCode' => $addressDTO->zipCode,
            'City' => $addressDTO->city,
            'State' => $addressDTO->state,
            'Country' => 'BR'
        ];
    }

    private function makePayment(): array
    {
        $payment = $this->split->payment;

        return [
                'Type' => $payment->type,
                'Amount' => $payment->amount,
                'Installments' => $payment->installments,
                'Capture' => (bool)$payment->capture,
                'SoftDescriptor' => $payment->softDescriptor,
                'SplitPayments' => $this->makeSplitPayments(),
                'FraudAnalysis' => $this->makeFraudAnalysis()
            ] + $this->makeCardType();
    }

    private function makeSplitPayments(): array
    {
        return array_map(function ($subordinateMerchant) {
            return $this->makeSubordinateMerchant($subordinateMerchant);
        }, $this->split->subordinateMerchants);
    }

    private function makeSubordinateMerchant(SubordinateMerchant $subordinateMerchant): array
    {
        return [
            'SubordinateMerchantId' => $subordinateMerchant->id,
            'Amount' => $subordinateMerchant->amount,
            'Fares' => [
                'mdr' => $subordinateMerchant->fares->mdr,
                'Fee' => $subordinateMerchant->fares->fee
            ]
        ];
    }

    private function makeFraudAnalysis()
    {
        $fraudAnalysis = $this->split->fraudAnalysis;

        return [
            'Sequence' => $fraudAnalysis->sequence,
            'SequenceCriteria' => $fraudAnalysis->sequenceCriteria,
            'Provider' => $fraudAnalysis->provider,
            'CaptureOnLowRisk' => $fraudAnalysis->captureOnLowRisk,
            'VoidOnHighRisk' => $fraudAnalysis->voidONHigRisk,
            'Shipping' => ['Addressee' => $fraudAnalysis->address],
            'Browser' => $this->makeFraudAnalysisBrowser(),
            'TotalOrderAmount' => $fraudAnalysis->totalOrderAmount,
            'TransactionAmount' => $fraudAnalysis->transactionAmount,
            'Cart' => $this->makeFraudAnalysisCart(),
        ];
    }

    private function makeFraudAnalysisBrowser(): array
    {
        $fraudAnalysis = $this->split->fraudAnalysis;
        return [
            'IpAddress' => $fraudAnalysis->browser->ipAddress,
            'BrowserFingerPrint' => $fraudAnalysis->browser->browserFingerPrint
        ];
    }

    private function makeFraudAnalysisCart(): array
    {
        $fraudAnalysis = $this->split->fraudAnalysis;

        $items = array_map(static function (CartItem $item) {
            return [
                'Name' => $item->name,
                'Quantity' => $item->quantity,
                'Sku' => $item->sku,
                'UnitPrice' => $item->unitPrice
            ];
        }, $fraudAnalysis->cart->items);

        return [
            'isGift' => $fraudAnalysis->cart->isGift,
            'returnsAccepted' => $fraudAnalysis->cart->returnsAccepted,
            'Item' => $items,
        ];
    }

    private function makeCardType()
    {
        $isCredit = $this->split->payment->card->cardType === CardType::CREDIT;

        if ($isCredit) {
            return [
                'CreditCard' => $this->makeCard(),
            ];
        }
        return [
            'Authenticate' => true,
            'ReturnUrl' => $this->returnUrl,
            'DebitCard' => $this->makeCard(),
        ];
    }

    private function makeCard(): array
    {
        $card = $this->split->payment->card;

        return [
            'CardToken' => $card->token,
            'SecurityCode' => $card->securityCode,
            'Brand' => $card->brand,
        ];
    }

}
