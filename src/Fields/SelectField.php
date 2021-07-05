<?php

namespace SunnyFlail\Html\Fields;

use OutOfRangeException;
use InvalidArgumentException;
use SunnyFlail\Html\Elements\SelectElement;
use SunnyFlail\Html\Interfaces\IFieldElement;
use SunnyFlail\Html\Traits\ElementTrait;
use SunnyFlail\Html\Interfaces\IInputElement;
use SunnyFlail\Html\Interfaces\ISelectableField;
use SunnyFlail\Html\Traits\FieldTrait;
use SunnyFlail\Html\Traits\SelectableTrait;

final class SelectField implements ISelectableField, IFieldElement
{

    use ElementTrait, SelectableTrait, FieldTrait;
    
    /** @var OptionElement[] $options */
    private array $options;

    public function __construct(
        string $name,
        protected bool $multiple = false,
        array $attributes = [],
        protected array $optionAttributes = [],
        protected array $availableOptions = [],
        protected string|array|null $value = null
    ) {
        $attributes["name"] = $name;
        $this->attributes = $attributes;
        $this->options = [];
    }

    public function resolve(array $values): bool
    {
        if ($this->mul  )
    }

    public function __toString(): string
    {
        $attributes = $this->attributes;
        $attributes["multiple"] = $this->multiple;

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

        return new SelectElement(
            name: $this->getFullName(),
            inputAttributes: $attributes
        );

        return '<select' . $this->getAttributeString($attributes) . '>' . implode('', $options) . '</select>';
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