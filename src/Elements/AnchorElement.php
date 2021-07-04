<?php

namespace SunnyFlail\Html\Elements;

use SunnyFlail\Html\Elements\ContainerElement;

final class AnchorElement extends ContainerElement
{
    public function __construct(
        string $href,
        array $attributes = [],
        array $nestedElements= [] 
    ) {
        $attributes["href"] = $href;

        parent::__construct(
            tag: "a",
            attributes: $attributes,
            nestedElements: $nestedElements
        );
    }

}