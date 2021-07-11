<?php

namespace SunnyFlail\HtmlAbstraction\Elements;

final class ButtonElement extends ContainerElement
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