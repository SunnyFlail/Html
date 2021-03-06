<?php

namespace SunnyFlail\HtmlAbstraction\Interfaces;

/**
 * Basic interface for HTML elements
 */
interface IElement
{

    /**
     * Returns an HTML string representation of Element
     * 
     * @return string
     */
    public function __toString(): string;

}