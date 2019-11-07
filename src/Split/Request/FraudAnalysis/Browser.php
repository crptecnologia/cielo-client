<?php

namespace CrpTecnologia\CieloClient\Split\Request\FraudAnalysis;

class Browser
{
    /**
     * @var string
     */
    public $ipAddress;
    /**
     * @var string
     */
    public $browserFingerPrint;

    public function __construct(string $ipAddress, string $browserFingerPrint)
    {
        $this->ipAddress = $ipAddress;
        $this->browserFingerPrint = $browserFingerPrint;
    }
}
