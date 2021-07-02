<?php

namespace SunnyFlail\Html\Constraints;

use SunnyFlail\Html\Interfaces\IConstraint;

final class GreaterThanConstraint implements IConstraint
{

    public function __construct(int|float $min) {}

    public function formValueValid($value): bool
    {
        if (!is_numeric($value)) {
            return false;
        }

        if ($value < $this->min) {
            return false;
        }

        return true;
    }

}