<?php

namespace SunnyFlail\HtmlAbstraction\Elements;

use SunnyFlail\HtmlAbstraction\Interfaces\IElement;
use SunnyFlail\HtmlAbstraction\Traits\AttributeTrait;

final class TextAreaElement implements IElement
{

    use AttributeTrait;
    private ?string $value;

    public function __construct(
        ?string $id = null,
        string $name,
        bool $required = true,
        array $attributes = [],
        ?array $classes = null,
        ?string $value = null,
    ) {
        $attributes["id"] = $id;
        $attributes["name"] = $name;
        $attributes["required"] = $required;
        $attributes["classes"] = $classes;
        $this->$attributes = $attributes;
        $this->$value = $value;
    }

    public function __toString(): string
    {
        $attributes = $this->attributes;

        return '<textarea' . $this->getAttributeString($attributes) . '>' . $this->value . '</textarea>';
    }

}