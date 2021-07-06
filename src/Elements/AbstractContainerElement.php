<?php

namespace SunnyFlail\Html\Elements;

use SunnyFlail\Html\Interfaces\IContainerElement;
use SunnyFlail\Html\Traits\ContainerElementTrait;
use SunnyFlail\Html\Traits\ElementTrait;

class ContainerElement implements IContainerElement
{

    use ElementTrait, ContainerElementTrait;

    public function __construct(
        protected string $tag = 'div',
        array $attributes,
        array $nestedElements
    ) {
        $this->attributes = $attributes;
        $this->nestedElements = $nestedElements;
    }

    public function __toString(): string
    {
        return '<' . $this->tag . $this->getAttributeString($this->attributes) . '>'
                . implode('', $this->nestedElements) . '</'. $this->tag. '>';
    }

}