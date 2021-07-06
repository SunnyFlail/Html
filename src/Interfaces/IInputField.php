<?php

namespace SunnyFlail\Html\Interfaces;

interface IInputField extends IFieldElement
{

    /**
     * Returns the name of input INSIDE the form
     * @example For field named 'text' inside form 'contact[]' it will be 'text' 
     * 
     * @return string
     */
    public function getName(): string;

    /**
     * Returns the name of input that will be used as attribute
     * @example For field named 'text' inside form 'contact[]' it will be 'contact[text]' 
     * 
     * @return string
     */
    public function getFullName(): string;

    /**
     * Returns the ID attribute of the used input
     * 
     * @return string
     */
    public function getInputId(): string;

    /**
     * Returns the error message with provided code;
     * 
     * @return string
     */
    public function resolveErrorMessage(string|int $code): string;

    
}