<?php

namespace SunnyFlail\Html\Elements;

final class EmailElement extends TextInputElement
{

    public function __construct(
        string $name,
        ?string $placeholder = null,
        ?array $classes = null,
        array $attributes = []
    ) {
        parent::__construct(
            type: "email",
            name: $name,
            minLength: 5,
            maxLength: 254,
            placeholder: $placeholder,
            classes: $classes,
            attributes: $attributes
        );
    }

}