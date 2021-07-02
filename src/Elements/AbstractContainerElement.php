<?php

namespace SunnyFlail\Html\Elements;

use SunnyFlail\Html\Interfaces\IContainerElement;
use SunnyFlail\Html\Traits\ContainerElementTrait;
use SunnyFlail\Html\Traits\ElementTrait;

abstract class AbstractContainerElement implements IContainerElement
{

    use ElementTrait;
    use ContainerElementTrait;

    public function __construct(
        protected string $tag,
        array $attributes,
        array $nestedElements
    ) {
        $this->attributes = $attributes;
        $this->nestedElements = $nestedElements;
    }

    public function __toString(): string
    {
        return '<' . $this->tag . $this->getAttributeString($this->attributes) . '>' . implode('', $this->nestedElements) . '</'. $this->tag. '>';
    }

}