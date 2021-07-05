<?php

namespace SunnyFlail\Html\Constraints;

use SunnyFlail\Html\Interfaces\IConstraint;

final class LesserThanConstraint implements IConstraint
{

    public function __construct(private int|float $max) {}

    public function formValueValid($value): bool
    {
        if (!is_numeric($value)) {
            return false;
        }

        return ($value > $this->max);
    }

}