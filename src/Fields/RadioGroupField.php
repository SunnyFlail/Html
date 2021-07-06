<?php

namespace SunnyFlail\Html\Fields;

use SunnyFlail\Html\Elements\CheckableElement;
use SunnyFlail\Html\Elements\ContainerElement;
use SunnyFlail\Html\Elements\LabelElement;
use SunnyFlail\Html\Interfaces\IInputField;
use SunnyFlail\Html\Interfaces\ISelectableField;
use SunnyFlail\Html\Traits\ContainerElementTrait;
use SunnyFlail\Html\Traits\FieldTrait;
use SunnyFlail\Html\Traits\InputFieldTrait;
use SunnyFlail\Html\Traits\SelectableTrait;

final class RadioGroupField implements ISelectableField, IInputField
{
    use ContainerElementTrait, FieldTrait, SelectableTrait, InputFieldTrait;

    public function __construct(
        protected string $name,
        protected array $options,
        protected array $inputAttributes = [],
        protected array $wrapperAttributes = [],
        protected array $labelAttributes = [],
        array $nestedElements = []
    )
    {
        $this->error = null;
        $this->value = null;
        $this->
        $this->nestedElements = $nestedElements;
    }

    public function resolve(array $values): bool
    {
        $value = $values[$this->name] ?? null;

        if (in_array($value, $this->optons)) {
            $this->value = $value;
            $this->valid = true;
        }

        return $this->valid;
    }

    public function __toString(): string
    {
        $inputs = [];
        $name = $this->getFullName();

        foreach ($this->options as $label => $value) {
            if (is_numeric($label)) {
                $label = $value;
            }

            $checked = $this->value === $value;

            $inputs[] = new LabelElement(
                labelText: $label,
                attributes: $this->labelAttributes,
                nestedElements: [
                    new CheckableElement(
                        name: $name,
                        radio: true,
                        checked: $checked,
                        attributes: $this->inputAttributes
                    )
                ]
            );
        }

        return new ContainerElement(
            attributes: $this->containerAttributes,
            nestedElements: $inputs
        );
    }
    
}