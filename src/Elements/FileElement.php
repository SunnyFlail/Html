<?php

namespace SunnyFlail\Html\Elements;

final class FileElement extends AbstractInputElement
{

    public function __construct(
        string $name,
        array $acceptedMimeTypes = [],
        bool $multiple = true,
        array $classes = [],
        array $attributes = []
    ) {

        $attributes["accept"] = $acceptedMimeTypes;
        $attributes["multiple"] = $multiple;

        parent::__construct(
            type: "file",
            name: $name,
            classes: $classes,
            attributes: $attributes
        );
    }

}