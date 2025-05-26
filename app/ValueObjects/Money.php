<?php

namespace App\ValueObjects;

class Money
{
    private int $cents;

    public function __construct(int $cents)
    {
        if($cents < 0)
        {
            throw new InvalidArgumentException("Amount cannot be negative");
        }

        $this->cents = $cents;
    }

    public function getCents(): int
    {
        return $this->cents;
    }
    
    public static function fromCents(int $cents): self
    {
        return new self($cents);
    }

    public static function fromReal(float $real): self
    {
        return new self((int) round($real * 100));
    }

    public function add(self $value): self
    {
        return new self($this->cents + $value->cents);
    }

    public function subtract(self $value): self
    {
        return new self($this->cents - $value->cents);
    }

    public function format(): string
    {
        return 'R$ ' . number_format($this->cents,2,',','.');
    }

    public function __toString(): string
    {
        return $this->format();
    }
}