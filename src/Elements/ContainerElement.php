<?php

namespace SunnyFlail\HtmlAbstraction\Elements;

use SunnyFlail\HtmlAbstraction\Interfaces\IContainerElement;
use SunnyFlail\HtmlAbstraction\Traits\AttributeTrait;
use SunnyFlail\HtmlAbstraction\Traits\ContainerElementTrait;

class ContainerElement implements IContainerElement
{

    use AttributeTrait, ContainerElementTrait;
    protected string $tag;

    public function __construct(
        array $attributes,
        array $nestedElements,
        string $tag = 'div',
    ) {
        $this->tag = $tag;
        $this->attributes = $attributes;
        $this->nestedElements = $nestedElements;
    }

    public function __toString(): string
    {
        return '<' . $this->tag . $this->getAttributeString($this->attributes) . '>'
                . implode('', $this->nestedElements) . '</'. $this->tag. '>';
    }

}