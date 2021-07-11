<?php

namespace SunnyFlail\HtmlAbstraction\Elements;

use SunnyFlail\HtmlAbstraction\Interfaces\IElement;
use SunnyFlail\HtmlAbstraction\Traits\AttributeTrait;
use SunnyFlail\HtmlAbstraction\Traits\ElementTrait;

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