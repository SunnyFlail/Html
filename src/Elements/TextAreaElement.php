<?php

namespace SunnyFlail\Html\Elements;

use SunnyFlail\Html\Interfaces\IInputElement;
use SunnyFlail\Html\Traits\ElementTrait;

final class TextAreaElement implements IInputElement
{

    use ElementTrait;

    public function __construct(
        
    ) {

    }

    public function withValue(mixed $value): IInputElement
    {
        $this->value = $value;
        return $this;
    }

    public function __toString(): string
    {
        $attributes = $this->attributes;

        return '<textarea' . $this->getAttributeString($attributes) . '>' . $this->value . '</textarea>';
    }

}