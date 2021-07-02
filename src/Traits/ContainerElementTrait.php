<?php

namespace SunnyFlail\Html\Traits;

use SunnyFlail\Html\Interfaces\IContainerElement;
use SunnyFlail\Html\Interfaces\IElement;

trait ContainerElementTrait
{
    /** @var IElement[] $nestedElements */
    protected array $nestedElements;
    
    public function withAddedNestedElements(IElement ...$Elements): IContainerElement
    {
        array_push($this->nestedElements, ...$Elements);
        return $this;
    }

    public function getNestedElements(): array
    {
        return $this->nestedElements;
    }

}