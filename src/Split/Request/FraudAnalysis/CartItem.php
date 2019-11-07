<?php

namespace CrpTecnologia\CieloClient\Split\Request\FraudAnalysis;

class CartItem
{
    /**
     * @var string
     */
    public $name;
    /**
     * @var int
     */
    public $quantity;
    /**
     * @var int
     */
    public $sku;
    /**
     * @var float
     */
    public $unitPrice;

    public function __construct(string $name, int $quantity, int $sku, float $unitPrice)
    {
        $this->name = $name;
        $this->quantity = $quantity;
        $this->sku = $sku;
        $this->unitPrice = $unitPrice;
    }

}
