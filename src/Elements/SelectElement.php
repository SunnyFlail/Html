<?php

namespace SunnyFlail\Html\Elements;

use OutOfRangeException;
use InvalidArgumentException;
use SunnyFlail\Html\Traits\ElementTrait;
use SunnyFlail\Html\Interfaces\IInputElement;

class SelectElement implements IInputElement
{

    use ElementTrait;
    
    /** @var OptionElement[] $options */
    private array $options;

    public function __construct(
        string $name,
        private bool $multiple = false,
        array $attributes = [],
        private array $optionAttributes = []
    ) {
        $this->attributes = $attributes;
        $this->options = [];
    }

    /**
     * Updates elements values for rendering
     * 
     * MUST be called AFTER SelectElement::withOptions
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
        if (!$this->multiple) {
            if (is_array($value)){
                throw new InvalidArgumentException(
                    "Select without multiple attribute can only have one selected vale!"
                );
            }
            if (!isset($this->options[$value])) {
                throw new OutOfRangeException(
                    sprintf(
                        "SelectElement with name %s doesn't have option with value %s!",
                        $this->name,
                        $value
                    )
                );
            }

            $this->options[$value]->setSelected();
            return $this;
        }

        if (!is_array($value)) {
            throw new InvalidArgumentException(
                "Select with multiple attribute must have an array of values!"
            );
        }

        foreach ($value as $val) {
            if (!isset($this->options[$val])) {
                throw new OutOfRangeException(
                    sprintf(
                        "SelectElement with name %s doesn't have option with value %s!",
                        $this->name,
                        $value
                    )
                );
            }

            $this->options[$val]->setSelected();
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
    public function withOptions(array $values): SelectElement
    {
        foreach ($values as $text => $value) {
            if (is_numeric($text)) {
                $text = $value;
            }
            $this->options[$value] = new OptionElement($value, $text, $this->optionAttributes);
        }
        
        return $this;
    }

    public function __toString(): string
    {
        $attributes = $this->attributes;
        $attributes["multiple"] = $this->multiple;

        return '<select' . $this->getAttributeString($attributes) . '>' . implode('', $this->options) . '</select>';
    }

}