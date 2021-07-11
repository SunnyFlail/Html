<?php

namespace SunnyFlail\HtmlAbstraction\Elements;

use SunnyFlail\HtmlAbstraction\Interfaces\IElement;
use SunnyFlail\HtmlAbstraction\Traits\AttributeTrait;

final class OptionElement implements IElement
{

    use AttributeTrait;

    protected TextNodeElement $textNode;

    public function __construct(
        string $value,
        string $optionText = "",
        array $attributes = [],
        bool $selected = false,
    )
    {
        $this->textNode = new TextNodeElement($optionText);
        $attributes["selected"] = $selected;
        $attributes["value"] = $value;
        $this->attributes = $attributes;
    }

    public function __toString(): string
    {
        return '<option' . $this->getAttributeString($this->attributes) . '>' . $this->textNode . '</option>';
    }

}