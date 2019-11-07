<?php

namespace CrpTecnologia\CieloClient\Split\Request\FraudAnalysis;

class MerchantDefinedField
{
    public const CUSTOMER_LOGIN = 1;
    /**
     * Quantidade em dias que o cliente é seu cliente
     */
    public const DAYS_CUSTOMER_HAS_ALREADY_CREATED = 2;
    public const INSTALLMENTS = 3;
    /**
     * Call Center -> compra pelo telefone
     * Web -> compra pela web
     * Portal -> um agente fazendo a compra para o cliente
     * Quiosque -> compras em quiosques
     * Movel -> compras feitas em celulares ou tablets
     */
    public const SALE_CHANEL = 4;
    public const DATE_OF_LAST_PURCHASE = 6;
    public const STORE_ID = 7;
    public const ORDER_PAYMENT_QUANTITY = 8;
    public const FREIGHT_AMOUNT = 21;
    public const LAST_DIGIT_CARD = 23;

    /**
     * @var int
     */
    public $id;
    /**
     * @var string
     */
    public $value;

    public function __construct(int $id, string $value)
    {
        $this->id = $id;
        $this->value = $value;
    }
}
