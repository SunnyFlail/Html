<?php

namespace SunnyFlail\HtmlAbstraction\Traits;

use SunnyFlail\HtmlAbstraction\Interfaces\IContainerElement;
use SunnyFlail\HtmlAbstraction\Interfaces\IElement;

/**
 * A trait for classes implementing IContainerElement interface
 */
trait ContainerElementTrait
{
    /**
     * @var IElement[] $nestedElements
     * */
    protected array $nestedElements;
    
    public function withAddedNestedElements(IElement ...$Elements): IContainerElement
    {
        array_push($this->nestedElements, ...$Elements);
        return $this;
    }

}