<?php

namespace SunnyFlail\Html\Elements;

use SunnyFlail\Html\Interfaces\IContainerElement;
use SunnyFlail\Html\Interfaces\IElement;
use SunnyFlail\Html\Traits\ContainerElementTrait;

/**
 * Representation of multiple elements
 * 
 * Kinda like Fragments in React
 * 
 */
final class NodeElement implements IElement, IContainerElement
{

    use ContainerElementTrait;

    public function __construct(array $nestedElements)
    {
        $this->nestedElements = $nestedElements;
    }

    public function __toString(): string
    {
        return implode('', $this->nestedElements);
    }

}