<?php

namespace SunnyFlail\Html\Interfaces;

interface IInputField extends IFieldElement
{

    /**
     * Returns the input element / node containing input elements
     * 
     * @return IElement
     */
    public function getInputElement(): IElement;
    
}