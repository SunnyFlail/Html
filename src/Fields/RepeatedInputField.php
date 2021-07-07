<?php

namespace SunnyFlail\Html\Fields;

use SunnyFlail\Html\Interfaces\IFieldElement;
use SunnyFlail\Html\Interfaces\IFormElement;
use SunnyFlail\Html\Interfaces\IInputField;
use SunnyFlail\Html\Traits\FieldTrait;

final class RepeatedInputField implements IFieldElement
{

    use FieldTrait;

    public function __construct(
        protected IInputField $field,
        protected IInputField $repeatedField,
        protected string $missmatchError = "Fields must match!"
    ) {
        $this->valid = false;
    }

    public function isRequired(): bool
    {
        return $this->field->isRequired();
    }

    public function getName(): string
    {
        return $this->field->getName();
    }

    public function getValue()
    {
        return $this->field->getValue();
    }

    public function withError(string $error): IFieldElement
    {
        $this->field->withError($error);
        return $this;
    }

    public function withValue(mixed $value): IFieldElement
    {
        $this->field->withValue($value);
        $this->repeatedField->withValue($value);
        return $this;
    }

    public function withForm(IFormElement $form): IFieldElement
    {
        $this->field->withForm($form);
        $this->repeatedField->withForm($form);
        return $this;
    }

    public function resolve(array $values): bool
    {
        $this->field->resolve($values);
        $this->repeatedField->resolve($values);

        if ($this->field->getValue() === $this->repeatedField->getValue()) {
            $this->valid = true;
        } else {
            $this->field->withError($this->mismatchError);
        }
        return $this->valid;
    }

    public function __toString(): string
    {
        return $this->field . $this->repeatedField;
    }

}