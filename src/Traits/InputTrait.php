<?php

namespace SunnyFlail\Html\Traits;

use SunnyFlail\Html\Interfaces\IInputElement;

trait InputTrait
{

    public function withValue(mixed $value): IInputElement
    {
        $this->value = $value;
        return $this;
    }

}