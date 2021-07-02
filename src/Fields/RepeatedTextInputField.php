<?php

namespace SunnyFlail\Html\Fields;

use InvalidArgumentException;
use SunnyFlail\Html\Interfaces\IFieldElement;
use SunnyFlail\Html\Interfaces\IFormElement;

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

    public function isRequired(): bool
    {
        return $this->field->isRequired();
    }

    public function getName(): string
    {
        return $this->field->getName();
    }

    public function withForm(IFormElement $form): IFieldElement
    {
        $this->field->withForm($form);
        $this->repeatedField->withForm($form);
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