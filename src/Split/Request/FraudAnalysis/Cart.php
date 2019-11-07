<?php

namespace CrpTecnologia\CieloClient\Split\Request\FraudAnalysis;

class Cart
{
    /**
     * @var bool
     */
    public $isGift;
    /**
     * @var bool
     */
    public $returnsAccepted;
    /**
     * @var array
     */
    public $items;

    /**
     * FraudAnalysis constructor.
     * @param bool $isGift
     * @param bool $returnsAccepted
     * @param CartItem[] $items
     */
    public function __construct(bool $isGift, bool $returnsAccepted, array $items)
    {
        $this->isGift = $isGift;
        $this->returnsAccepted = $returnsAccepted;
        $this->items = $items;
    }
}
