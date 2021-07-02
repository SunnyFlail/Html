<?php

namespace SunnyFlail\Html\Traits;

use SunnyFlail\Html\Interfaces\IInputElement;

trait InputableElementTrait
{

    use ElementTrait;

    protected mixed $value;

    public function withValue(mixed $value): IInputElement
    {
        $this->value = $value;
        return $this;
    }

}