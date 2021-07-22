<?php

namespace SunnyFlail\HtmlAbstraction\Elements;

use SunnyFlail\HtmlAbstraction\Interfaces\IElement;
use SunnyFlail\HtmlAbstraction\Traits\AttributeTrait;

final class SelectElement implements IElement
{

    use AttributeTrait;
    
    /** @var OptionElement[] $options */
    protected array $options;

    public function __construct(
        string $name,
        string $id,
        bool $required = true,
        bool $multiple = false,
        array $attributes = [],
        array $options = [],
    ) {
        $attributes["name"] = $name;
        $attributes["id"] = $id;
        $attributes["required"] = $required;
        $attributes["multiple"] = $multiple;
        $this->options = $options;
        $this->attributes = $attributes;
    }

    public function __toString(): string
    {
        return '<select' . $this->getAttributeString($this->attributes) . '>'
                . implode('', $this->options) . '</select>';
    }

}