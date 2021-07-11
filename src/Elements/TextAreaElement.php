<?php

namespace SunnyFlail\HtmlAbstraction\Elements;

use SunnyFlail\HtmlAbstraction\Interfaces\IElement;
use SunnyFlail\HtmlAbstraction\Traits\AttributeTrait;

final class TextAreaElement implements IElement
{

    use AttributeTrait;

    public function __construct(
        string $name,
        array $attributes = [],
        private ?string $value = null,
    ) {
        $attributes["name"] = $name;
        $this->$attributes = $attributes;
    }

    public function __toString(): string
    {
        $attributes = $this->attributes;

        return '<textarea' . $this->getAttributeString($attributes) . '>' . $this->value . '</textarea>';
    }

}