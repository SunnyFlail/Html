<?php

namespace SunnyFlail\Html\Elements;

use SunnyFlail\Html\Interfaces\IElement;
use SunnyFlail\Html\Traits\AttributeTrait;
use SunnyFlail\Html\Traits\ElementTrait;

final class SelectElement implements IElement
{

    use AttributeTrait;
    
    /** @var OptionElement[] $options */

    public function __construct(
        string $name,
        string $id,
        bool $required = true,
        bool $multiple = false,
        array $attributes = [],
        protected array $options = [],
    ) {
        $attributes["name"] = $name;
        $attributes["id"] = $id;
        $attributes["required"] = $required;
        $attributes["multiple"] = $multiple;
        $this->attributes = $attributes;
    }

    public function __toString(): string
    {
        return '<select' . $this->getAttributeString($this->attributes) . '>'
                . implode('', $this->options) . '</select>';
    }

}