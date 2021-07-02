<?php

namespace SunnyFlail\Html\Elements;

use SunnyFlail\Html\Elements\AbstractContainerElement;

final class AnchorElement extends AbstractContainerElement
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