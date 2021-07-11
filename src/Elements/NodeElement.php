<?php

namespace SunnyFlail\HtmlAbstraction\Elements;

use SunnyFlail\HtmlAbstraction\Interfaces\IContainerElement;
use SunnyFlail\HtmlAbstraction\Interfaces\IElement;
use SunnyFlail\HtmlAbstraction\Traits\ContainerElementTrait;

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