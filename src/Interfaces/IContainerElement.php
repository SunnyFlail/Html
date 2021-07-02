<?php

namespace SunnyFlail\Html\Interfaces;

interface IContainerElement extends IElement
{

    public function getNestedElements(): array;

    public function withAddedNestedElements(IElement ...$Elements): IContainerElement;

}