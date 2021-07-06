<?php

namespace SunnyFlail\Html\Elements;

use SunnyFlail\Html\Interfaces\IElement;

class InputElement extends AbstractInputElement implements IElement
{

    public function __construct(
        string $type = "text",
        string $id,
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
            id: $id,
            classes: $classes,
            required: $required,
            attributes: $attributes
        );
    }

}