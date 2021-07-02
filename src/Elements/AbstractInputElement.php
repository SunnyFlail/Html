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
        protected bool $required,
        array $attributes = [],
    ) {
        $attributes["type"] = $type;
        $attributes["name"] = $name;
        $attributes["classes"] = $classes;

        $this->attributes = $attributes;
    }

    public function isRequired(): bool
    {
        return $this->required;
    }

    public function withName(string $name): AbstractInputElement
    {
        $this->attributes["name"] = $name;
        return $this;
    }

    public function __toString(): string
    {
        $attributes = $this->attributes;
        $attributes["required"] = $this->required;

        return '<input' . $this->getAttributeString($attributes) . '>';
    }

}