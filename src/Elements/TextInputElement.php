<?php

namespace SunnyFlail\Html\Elements;

use SunnyFlail\Html\Interfaces\IInputElement;
use SunnyFlail\Html\Traits\ElementTrait;

abstract class TextInputElement extends AbstractInputElement implements IInputElement
{

    public function __construct(
        string $type = "text",
        ?string $name,
        ?string $placeholder = null,
        ?array $classes = null,
        $value = null,
        array $attributes = [],
        ?int $minLength = null, 
        ?int $maxLength = null
    ) {
        $attributes["type"] = $type;
        $attributes["name"] = $name;
        $attributes["placeholder"] = $placeholder;
        $attributes["classes"] = $classes;
        $attributes["minlength"] = $minLength;
        $attributes["maxlength"] = $maxLength;
        $attributes["value"] = $value;

        $this->attributes = $attributes;
    }

    public function withName(string $name): TextInputElement
    {
        $this->attributes["name"] = $name;
        return $this;
    }

    public function withValue(mixed $value): IInputElement
    {
        $this->attributes["value"] = $value;
        return $this;
    }

    public function __toString(): string
    {
        return '<input' . $this->getAttributeString($this->attributes) . '>';
    }

}