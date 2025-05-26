<?php

namespace App\Casts;

use App\ValueObjects\Money;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use InvalidArgumentException;

class MoneyCast implements CastsAttributes
{
    public function get($model, $key, $value, $attributes)
    {
        if ($value === null) {
            return null;
        }

        return new Money((int) $value);
    }

    public function set($model, $key, $value, $attributes)
    {
        if ($value === null) {
            return null;
        }

        if (!($value instanceof Money)) {
            throw new InvalidArgumentException('The given value is not a Money instance.');
        }

        return $value->getCents();
    }
}