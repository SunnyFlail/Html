<?php

namespace SunnyFlail\Html\Interfaces;

/**
 * Interface for Elements that can have input from user
 */
interface IInputElement extends IElement
{

    public function withValue(mixed $value): IInputElement;
    
}