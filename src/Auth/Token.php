<?php

namespace CrpTecnologia\CieloClient\Auth;

class Token
{
    /**
     * @var string
     */
    private $toke;
    /**
     * @var int
     */
    private $expiresIn;

    public function __construct(string $toke, int $expiresIn)
    {
        $this->toke = $toke;
        $this->expiresIn = $expiresIn;
    }

    public function isNotExpired(): bool
    {
        return $this->isExpired() === false;
    }

    public function isExpired(): bool
    {
        return $this->expiresIn >= time();
    }

    public function __toString()
    {
        return "Bearer {$this->toke}";
    }
}
