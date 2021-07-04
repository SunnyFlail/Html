<?php

namespace SunnyFlail\Html\Elements;

use OutOfRangeException;
use InvalidArgumentException;
use SunnyFlail\Html\Traits\ElementTrait;
use SunnyFlail\Html\Interfaces\IInputElement;

final class SelectElement implements IInputElement
{

    use ElementTrait;
    
    /** @var OptionElement[] $options */
    private array $options;

    public function __construct(
        string $name,
        private bool $multiple = false,
        array $attributes = [],
        private array $optionAttributes = [],
        private array $availableOptions = [],
        private string|array $value
    ) {
        $attributes["name"] = $name;
        $this->attributes = $attributes;
        $this->options = [];
    }

    /**
     * Updates elements values for rendering
     * 
     * @param mixed $value
     * 
     * @return IInputElement
     * 
     * @throws InvalidArgumentException
     * @throws OutOfRangeException 
     */
    public function withValue(mixed $value): IInputElement
    {
        if (!$this->multiple && is_array($value)) {
            throw new InvalidArgumentException(
                "Select without multiple attribute can only have one selected value!"
            );
        }

        if (!is_array($value)) {
            throw new InvalidArgumentException(
                "Select with multiple attribute must have an array of values!"
            );
        }

        return $this;
    }

    /**
     * Fills the select with possible Options
     * 
     * @var string[]|int[]|bool[] $values Keys will serve as a label for values, value if key is numeric
     * 
     * @return SelectElement
     */
    public function withOptions(array $options): SelectElement
    {
        $this->options = $options;
        return $this;
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