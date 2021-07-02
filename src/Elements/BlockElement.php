<?php

namespace SunnyFlail\Html\Elements;

use SunnyFlail\Html\Traits\ContainerElementTrait;

class BlockElement extends AbstractContainerElement
{
    use ContainerElementTrait;

    public function __construct(
        array $attributes = [],
        array $nestedElements = []
    )
    {
        parent::__construct(
            tag: "div",
            attributes: $attributes,
            nestedElements: $nestedElements
        );
    }

}