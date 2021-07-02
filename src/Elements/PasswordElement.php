<?php

namespace SunnyFlail\Html\Elements;

final class PasswordElement extends TextInputElement
{

    public function __construct(
        string $name,
        ?string $placeholder = null,
        ?array $classes = null,
        array $attributes = [],
    ) {

        parent::__construct(
            type: "password",
            name: $name,
            placeholder: $placeholder,
            attributes: $attributes,
            classes: $classes,
        );
    }

}