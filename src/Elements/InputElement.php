<?php

namespace SunnyFlail\HtmlAbstraction\Elements;

use SunnyFlail\HtmlAbstraction\Interfaces\IElement;

class InputElement extends AbstractInputElement implements IElement
{

    public function __construct(
        ?string $id = null,
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
            id: $id,
            classes: $classes,
            required: $required,
            attributes: $attributes
        );
    }

}