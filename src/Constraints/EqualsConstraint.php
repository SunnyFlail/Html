<?php

namespace SunnyFlail\Html\Constraints;

use SunnyFlail\Html\Interfaces\IConstraint;

final class EqualsConstraint implements IConstraint
{

    public function __construct(private int|float $equals) {}

    public function formValueValid($value): bool
    {
        if (!is_numeric($value)) {
            return false;
        }

        if (is_int($this->equals) && is_int($value)) {
            return ($this->equals === $value);
        }

        if (abs($this->equals - $value) < PHP_FLOAT_EPSILON) {
            return true;
        }

        return false;
    }

}