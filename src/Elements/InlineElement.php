<?php

namespace SunnyFlail\Html\Elements;

use SunnyFlail\Html\Interfaces\IContainerElement;
use SunnyFlail\Html\Traits\ContainerElementTrait;

class InlineElement extends AbstractContainerElement
{
    use ContainerElementTrait;

    public function __construct(
        array $attributes = [],
        array $nestedElements = []
    )
    {
        parent::__construct(
            tag: "span",
            attributes: $attributes,
            nestedElements: $nestedElements
        );
    }

}