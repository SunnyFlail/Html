<?php

namespace SunnyFlail\Html\Interfaces;

interface IFieldElement extends IInputElement
{

    public function resolve(array $values): bool;

    public function getName(): string;

    public function withError(string $error): IFieldElement;

    public function withForm(IFormElement $form): IFieldElement;

    /**
     * Returns the user provided value
     * 
     * MUST be called AFTER resolve
     */
    public function getValue();

    public function isRequired(): bool;

    public function isValid(): bool;

}