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

    public function __construct(
        string $name,
        array $inputAttributes = [],
        protected array $options = [],
    ) {
        $attributes["name"] = $name;
        $this->attributes = $inputAttributes;
        $this->options = [];
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

    public function withValue(mixed $value): IInputElement
    {
        $this->
    }

    public function __toString(): string
    {
        return '<select' . $this->getAttributeString($this->attributes) . '>'
                . implode('', $this->options) . '</select>';
    }

}