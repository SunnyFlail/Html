<?php

namespace SunnyFlail\Html\Elements;

use SunnyFlail\Html\Interfaces\IElement;
use SunnyFlail\Html\Traits\ElementTrait;

final class OptionElement implements IElement
{

    use ElementTrait;

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

    public function getValue(): string
    {
        return  $this->attributes["value"];
    }

    public function setSelected(): OptionElement
    {
        $this->attributes["selected"] = true;
        return $this;
    }

    public function __toString(): string
    {
        return '<option' . $this->getAttributeString($this->attributes) . '>' . $this->textNode . '</option>';
    }

}