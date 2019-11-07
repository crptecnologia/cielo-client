<?php

namespace CrpTecnologia\CieloClient\TokenizationCard;

class CardTokenizationRequest
{
    /**
     * @var string
     */
    public $number;
    /**
     * @var string
     */
    public $holder;
    /**
     * @var string
     */
    public $expirationDate;
    /**
     * @var string
     */
    public $brand;
    /**
     * @var string
     */
    public $customerName;

    public function __construct(
        string $number,
        string $customerName,
        string $holder,
        string $expirationDate,
        string $brand
    ) {
        $this->number = $number;
        $this->customerName = $customerName;
        $this->holder = $holder;
        $this->expirationDate = $expirationDate;
        $this->brand = $brand;
    }

    public function jsonSerialize()
    {
        return [
            'CardNumber' => $this->number,
            'CustomerName' => $this->customerName,
            'Holder' => $this->holder,
            'ExpirationDate' => $this->expirationDate,
            'Brand' => $this->brand
        ];
    }
}
