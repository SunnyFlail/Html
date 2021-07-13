<?php

namespace SunnyFlail\HtmlAbstraction\Elements;

use SunnyFlail\HtmlAbstraction\Interfaces\IElement;
use SunnyFlail\HtmlAbstraction\Traits\AttributeTrait;

abstract class AbstractInputElement implements IElement
{

    use AttributeTrait;

    public function __construct(
        string $type,
        string $id,
        ?string $name = null,
        ?array $classes = null,
        bool $required = true,
        array $attributes = [],
    ) {
        $attributes["type"] = $type;
        $attributes["id"] = $id;
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