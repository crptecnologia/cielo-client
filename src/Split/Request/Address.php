<?php

namespace CrpTecnologia\CieloClient\Split\Request;

class Address
{
    /**
     * @var string
     */
    public $street;
    /**
     * @var string
     */
    public $district;
    /**
     * @var string
     */
    public $number;
    /**
     * @var string
     */
    public $complement;
    /**
     * @var string
     */
    public $zipCode;
    /**
     * @var string
     */
    public $city;
    /**
     * @var string
     */
    public $state;
    /**
     * @var string
     */
    public $country;

    public function __construct(
        string $street,
        string $district,
        string $number,
        string $complement,
        string $zipCode,
        string $city,
        string $state,
        string $country
    ) {
        $this->street = $street;
        $this->district = $district;
        $this->number = $number;
        $this->complement = $complement;
        $this->zipCode = $zipCode;
        $this->city = $city;
        $this->state = $state;
        $this->country = $country;
    }

}
