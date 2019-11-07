<?php

namespace CrpTecnologia\CieloClient\Split\Request;

class SubordinateMerchant
{

    /**
     * @var string
     */
    public $id;
    /**
     * @var int
     */
    public $amount;
    /**
     * @var Fares
     */
    public $fares;

    public function __construct(string $id, int $amount, Fares $fares)
    {
        $this->id = $id;
        $this->amount = $amount;
        $this->fares = $fares;
    }
}
