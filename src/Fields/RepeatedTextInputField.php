<?php

namespace SunnyFlail\Html\Fields;

use InvalidArgumentException;
use SunnyFlail\Html\Interfaces\IFieldElement;
use SunnyFlail\Html\Interfaces\IFormElement;
use SunnyFlail\Html\Interfaces\IInputElement;
use SunnyFlail\Html\InvalidFieldException;

final class RepeatedField implements IFieldElement
{

    private bool $valid;

    public function __construct(
        private IFieldElement $field,
        private IFieldElement $repeatedField,
        private string $mismatchError = "Fields must match!"
    ) {
        $this->valid = false;
    }

    public function withError(string $error): IFieldElement
    {
        $this->field->withError($error);
        return $this;
    }

    public function withValue(mixed $value): IInputElement
    {
        $this->field->withValue($value);
        return $this;
    }

    public function isRequired(): bool
    {
        return $this->field->isRequired();
    }

    public function getName(): string
    {
        return $this->field->getName();
    }

    public function isValid(): bool
    {
        return $this->valid;
    }

    public function getValue()
    {
        if (!$this->valid) {
            throw new InvalidFieldException(
                sprintf('Trying to get value of an invalid %s', static::class)
            );
        }
        return $this->field->getValue();
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