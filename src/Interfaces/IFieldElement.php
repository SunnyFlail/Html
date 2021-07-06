<?php

namespace SunnyFlail\Html\Interfaces;

interface IFieldElement extends IElement
{

    public function resolve(array $values): bool;

    /**
     * Adds an error message to the field
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