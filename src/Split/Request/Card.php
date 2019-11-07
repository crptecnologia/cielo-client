<?php

namespace CrpTecnologia\CieloClient\Split\Request;

/**
 * Class Card
 * @package Split\Request
 */
class Card
{
    /**
     * @var string
     */
    public $token;
    /**
     * @var string
     */
    public $securityCode;
    /**
     * @var string
     */
    public $brand;
    /**
     * @var string
     */
    public $cardType;

    public function __construct(
        string $token,
        string $securityCode,
        string $brand,
        string $type
    ) {
        $this->token = $token;
        $this->securityCode = $securityCode;
        $this->brand = $brand;
        $this->cardType = $type;
    }

}
