<?php

namespace CrpTecnologia\CieloClient\Split\Request;

use DateTime;

class Customer
{
    public const STATUS_EXISTING = 'EXISTING';
    public const STATUS_NEW = 'NEW';
    /**
     * @var string
     */
    public $name;
    /**
     * @var string
     */
    public $status;
    /**
     * @var string
     */
    public $cpf;
    /**
     * @var string
     */
    public $email;
    /**
     * @var DateTime
     */
    public $birthday;
    /**
     * @var Address
     */
    public $address;
    /**
     * @var string
     */
    public $cellPhone;

    public function __construct(
        string $name,
        string $status,
        string $cpf,
        string $email,
        DateTime $birthday,
        Address $address,
        string $cellPhone
    ) {
        $this->name = $name;
        $this->status = $status;
        $this->cpf = $cpf;
        $this->email = $email;
        $this->birthday = $birthday;
        $this->address = $address;
        $this->cellPhone = $cellPhone;
    }

}
