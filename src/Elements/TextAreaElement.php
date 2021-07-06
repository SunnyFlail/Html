<?php

namespace SunnyFlail\Html\Elements;

use SunnyFlail\Html\Interfaces\IElement;
use SunnyFlail\Html\Traits\AttributeTrait;

final class TextAreaElement implements IElement
{

    use AttributeTrait;

    public function __construct(
        string $name,
        array $attributes = [],
        private ?string $value = null,
    ) {
        $attributes["name"] = $name;
        $this->$attributes = $attributes;
    }

    public function __toString(): string
    {
        $attributes = $this->attributes;

        return '<textarea' . $this->getAttributeString($attributes) . '>' . $this->value . '</textarea>';
    }

}