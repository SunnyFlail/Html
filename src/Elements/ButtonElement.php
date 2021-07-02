<?php

namespace SunnyFlail\Html\Elements;

final class ButtonElement extends AbstractContainerElement
{

    public function __construct(
        string $type = "submit",
        array $attributes = [],
        ?string $text = null,
        array $nestedElements = []
    ) {

        $attributes["type"] = $type;
        if ($text) {
            $nestedElements[] = new TextNodeElement($text);
        }
        parent::__construct(
            tag: "button",
            attributes: $attributes,
            nestedElements: $nestedElements
        );

    }

}