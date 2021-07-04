<?php

namespace SunnyFlail\Html\Elements;

use SunnyFlail\Html\Interfaces\IInputElement;

class InputElement extends AbstractInputElement implements IInputElement
{

    public function __construct(
        string $type = "text",
        ?string $name = null,
        ?array $classes = null,
        bool $required = true,
        $value = null,
        array $attributes = []
    ) {
        $attributes["value"] = $value;
        
        parent::__construct(
            type: $type,
            name: $name,
            classes: $classes,
            required: $required,
            attributes: $attributes
        );
    }

    public function withValue(mixed $value): IInputElement
    {
        $this->attributes["value"] = $value;
        return $this;
    }

}