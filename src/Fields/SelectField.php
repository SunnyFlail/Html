<?php

namespace SunnyFlail\Html\Fields;

use SunnyFlail\Html\Elements\ContainerElement;
use SunnyFlail\Html\Elements\LabelElement;
use SunnyFlail\Html\Elements\OptionElement;
use SunnyFlail\Html\Elements\SelectElement;
use SunnyFlail\Html\Elements\TextNodeElement;
use SunnyFlail\Html\Interfaces\IInputField;
use SunnyFlail\Html\Interfaces\ISelectableField;
use SunnyFlail\Html\Traits\AttributeTrait;
use SunnyFlail\Html\Traits\FieldTrait;
use SunnyFlail\Html\Traits\InputFieldTrait;
use SunnyFlail\Html\Traits\SelectableTrait;

final class SelectField implements ISelectableField, IInputField
{

    use AttributeTrait, SelectableTrait, FieldTrait, InputFieldTrait;
    
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
        array $errorMessages = [],
        protected string|array|null $value = null
    ) {
        $this->error = null;
        $this->valid = false;
        $this->value = null;
        $this->errorMessages = $errorMessages;
    }

    public function resolve(array $values): bool
    {
        $value = $values[$this->getName()] ?? null;

        if ($this->required && null === $value) {
            $this->error = $this->resolveErrorMessage("-1");

            return false;
        }

        if ($this->multiple && is_array($value)) {
            $value = array_intersect($value, $this->option);

            if (!$value) {
                $this->error = $this->resolveErrorMessage("0");
            }

            return false;
        }

        if (!in_array($value, $this->options)) {
            $this->error = $this->resolveErrorMessage("0");

            return false;
        }

        $this->value = $value;

        return $this->valid = true;
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
            $errors[] = new ContainerElement(
                attributes: $this->errorAttributes,
                nestedElements: [
                    new TextNodeElement($this->error)
                ]
            );
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
                ),
                ...$errors
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