<?php

namespace SunnyFlail\HtmlAbstraction\Interfaces;

interface IContainerElement extends IElement
{

    /**
     * Add a new element at the end of container
     * 
     * @return IContainerElement $this
     */
    public function withAddedNestedElements(IElement ...$Elements): IContainerElement;

}