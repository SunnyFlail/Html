<?php

namespace SunnyFlail\Html\Elements;

final class CheckableElement extends InputElement
{
    public function __construct(
        ?string $name = null,
        bool $radio = false,
        bool $checked = false,
        ?array $classes = null,
        bool $required = true,
        $value = null,
        array $attributes = []
    ) {
        $attributes["checked"] = $checked;
        $type = $radio ? "radio" : "checkbox";
        parent::__construct(
            type: $type,
            name: $name,
            classes: $classes,
            required: $required,
            value: $value,
            attributes: $attributes
        );
    }
}