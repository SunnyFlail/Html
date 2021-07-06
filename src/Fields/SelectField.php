<?php

namespace SunnyFlail\Html\Fields;

use SunnyFlail\Html\Elements\ContainerElement;
use SunnyFlail\Html\Elements\LabelElement;
use SunnyFlail\Html\Elements\OptionElement;
use SunnyFlail\Html\Elements\SelectElement;
use SunnyFlail\Html\Interfaces\IElement;
use SunnyFlail\Html\Interfaces\IFieldElement;
use SunnyFlail\Html\Interfaces\ISelectableField;
use SunnyFlail\Html\Traits\AttributeTrait;
use SunnyFlail\Html\Traits\FieldTrait;
use SunnyFlail\Html\Traits\SelectableTrait;

final class SelectField implements ISelectableField, IFieldElement
{

    use AttributeTrait, SelectableTrait, FieldTrait;
    
    /** @var string[]|string[][] $options */

    public function __construct(
        protected string $name,
        protected bool $multiple = false,
        protected bool $required = false,
        protected array $inputAttributes = [],
        protected ?string $labelText = null,
        protected array $labelAttributes = [],
        protected array $optionAttributes = [],
        protected array $errorAttributes = [],
        protected array $options = [],
        protected string|array|null $value = null
    ) {
        $this->error = null;
        $this->valid = false;
        $this->value = null;
    }

    public function resolve(array $values): bool
    {
        $values = $values[$this->getName()] ?? [];

        if ($this->multiple && is_array($values)) {
            $values = array_intersect($this->options, $values);

            if ($this->required && !$values) {
                $this->error = $this->errorMessages["-1"] ?? "A value must be provided!";
                $this->valid = false; 
            }

            $this->value = $values;
            return $this->valid = true;
        }

        if (!in_array($values, $this->options) && $this->required) {
            $this->error = $this->errorMessages["0"] ?? "Provided value is incorrect!";

            return $this->valid;
        }

        $this->value = $values;

        return $this->valid;
    }

    public function __toString(): string
    {
        $options = [];
        foreach ($this->options as $label => $value) {
            /** Check if this is a group */
            if (is_array($value)) {
                $options[] = new ContainerElement(
                    tag: 'optgroup',
                    attributes: ['label' => $label],
                    nestedElements: array_map(
                        [$this, "createOption"],
                        array_keys($value),
                        $value
                    )
                );
                continue;
            }

            $options[] = $this->createOption($label, $value);
        }

        $errors = [];

        if (null !== $this->error) {
            $errors[] = new ContainerElement()
        }

        $inputId = $this->getInputId();

        return new ContainerElement(
            attributes: $this->containerAttibutes,
            nestedElements: [
                new LabelElement(
                    for: $inputId,
                    labelText: $this->labelText ?? $this->name,
                    attributes: $this->labelAttributes
                ),
                new SelectElement(
                    id: $inputId,
                    required: $this->required,
                    multiple: $this->multiple,
                    name: $this->getFullName(),
                    attributes: $this->inputAttributes,
                    options: $options
                )
            ]
        );
    }

    private function createOption(string $label, string $value): OptionElement
    {
        if (is_numeric($label)) {
            $label = $value;
        }

        if ($this->multiple && is_array($this->value)) {
            $selected = in_array($value, $this->value);
        } else {
            $selected = ($value === $this->value);
        }

        return new OptionElement(
            value: $value,
            optionText: $label,
            attributes: $this->optionAttributes,
            selected: $selected
        );
    }

}