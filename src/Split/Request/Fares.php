<?php

namespace CrpTecnologia\CieloClient\Split\Request;

class Fares
{
    /**
     * @var string
     */
    public $mdr;
    /**
     * @var string
     */
    public $fee;

    public function __construct(string $mdr, string $fee)
    {
        $this->mdr = $mdr;
        $this->fee = $fee;
    }

    public function jsonSerialize()
    {
        return [
            'mdr' => $this->mdr,
            'fee' => $this->fee,
        ];
    }
}
