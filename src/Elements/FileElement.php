<?php

namespace SunnyFlail\Html\Elements;

final class FileElement extends AbstractInputElement
{

    public function __construct(
        string $name,
        string $id,
        array $acceptedMimeTypes = [],
        bool $multiple = true,
        array $classes = [],
        array $attributes = []
    ) {

        $attributes["accept"] = $acceptedMimeTypes;
        $attributes["multiple"] = $multiple;

        parent::__construct(
            type: "file",
            id: $id,
            name: $name,
            classes: $classes,
            attributes: $attributes
        );
    }

}