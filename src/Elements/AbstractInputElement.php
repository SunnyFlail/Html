<?php

namespace SunnyFlail\Html\Elements;

use SunnyFlail\Html\Interfaces\IElement;
use SunnyFlail\Html\Traits\ElementTrait;

abstract class AbstractInputElement implements IElement
{

    use ElementTrait;

    public function __construct(
        string $type,
        ?string $name,
        ?array $classes = null,
        bool $required = true,
        array $attributes = [],
    ) {
        $attributes["type"] = $type;
        $attributes["name"] = $name;
        $attributes["classes"] = $classes;
        $attributes["required"] = $required;

        $this->attributes = $attributes;
    }

    public function __toString(): string
    {
        return '<input' . $this->getAttributeString($this->attributes) . '>';
    }

}