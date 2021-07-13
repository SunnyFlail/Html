<?php

namespace SunnyFlail\HtmlAbstraction\Elements;

use SunnyFlail\HtmlAbstraction\Interfaces\IContainerElement;
use SunnyFlail\HtmlAbstraction\Traits\ContainerElementTrait;
use SunnyFlail\HtmlAbstraction\Traits\ElementTrait;

class ContainerElement implements IContainerElement
{

    use ElementTrait, ContainerElementTrait;

    public function __construct(
        array $attributes,
        array $nestedElements,
        protected string $tag = 'div',
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