<?php

namespace SunnyFlail\Html\Traits;

use SunnyFlail\Html\Interfaces\IFieldElement;

/**
 * Trait extending FieldTrait for classes implementing IInputField interface
 */
trait InputFieldTrait
{
    /** @var string $name Name of the input element */
    protected string $name;
    /** @var bool $required Boolean indicating whether this field is required */
    protected bool $required;
    /** @var mixed $value Value of the field */
    protected mixed $value;

    public function getName(): string
    {
        return $this->name;
    }

    public function getFullName(): string
    {
        return $this->form->getName() . '[' . $this->name . ']';
    }

    public function getInputId(): string
    {
        return $this->form->getName() . "-"  . $this->name;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function resolveErrorMessage(string $code): string
    {
        if (!isset($this->errorMessages[$code])) {
            switch ($code) {
                case "-1":
                    return "This field must be filled!";
                default:
                    return "Value doesn't fit in with constraints!";
            }
        }

        return $this->errorMessages[$code];
    }

    public function withValue($value): IFieldElement
    {
        $this->value = $value;
        return $this;
    }

}