<?php

namespace CrpTecnologia\CieloClient\Auth;

class Credentials
{

    /**
     * @var string
     */
    private $id;
    /**
     * @var string
     */
    private $secret;

    public function __construct(string $id, string $secret)
    {
        $this->id = $id;
        $this->secret = $secret;
    }

    public function __toString()
    {
        return base64_encode("{$this->id}:$this->secret");
    }
}
