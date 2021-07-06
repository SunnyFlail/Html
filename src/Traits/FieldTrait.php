<?php

namespace SunnyFlail\Html\Traits;

use SunnyFlail\Html\Interfaces\IFieldElement;
use SunnyFlail\Html\Interfaces\IFormElement;
use SunnyFlail\Html\InvalidFieldException;

trait FieldTrait
{

    protected IFormElement $form;
    protected bool $valid;
    /** @var mixed $value */
    protected $value;
    /** @var string|null $error Message that is shown if this field is invalid */
    protected ?string $error;

    public function isValid(): bool
    {
        return $this->valid;
    }

    public function isRequired(): bool
    {
        return $this->required;
    }

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

    public function withValue($value): IFieldElement
    {
        $this->value = $value;
        return $this;
    }

    public function withError(string $error): IFieldElement
    {
        $this->error = $error;
        return $this;
    }

    public function withForm(IFormElement $form): IFieldElement
    {
        $this->form = $form;
        return $this;
    }

    public function getValue()
    {
        if (!$this->valid && $this->isRequired()) {
            throw new InvalidFieldException(
                sprintf("Tried to get value of an invalid field %s with name %s!", static::class, $this->name)
            );
        }

        return $this->value;
    }

}