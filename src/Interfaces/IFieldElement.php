<?php

namespace SunnyFlail\Html\Interfaces;

interface IFieldElement extends IElement
{

    public function resolve(array $values): bool;

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
     * Adds an error message to the input
     * 
     * @return IFieldElement $this
     */
    public function withError(string $error): IFieldElement;

    /**
     * Adds a reference to the parent form
     * 
     * @return IFieldElement $this
     */
    public function withForm(IFormElement $form): IFieldElement;

    /**
     * Adds a value to the form AND sets it to be valid
     * 
     * @return IFieldElement $this
     */
    public function withValue(mixed $value): IFieldElement;

    /**
     * Returns the user provided value
     * 
     * MUST be called AFTER resolve
     */
    public function getValue();

    public function isRequired(): bool;

    public function isValid(): bool;

}