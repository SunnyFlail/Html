<?php

namespace SunnyFlail\HtmlAbstraction\Elements;

use SunnyFlail\HtmlAbstraction\Interfaces\IElement;
use SunnyFlail\HtmlAbstraction\Traits\ElementTrait;

final class ImageElement implements IElement
{

    use ElementTrait;

    public function __construct(
        string $src,
        ?string $alt = null,
        array $attributes = []
    ) {
        $attributes["src"] = $src;
        $attributes["alt"] = $alt;
        $this->attributes = $attributes;
    }

    public function __toString(): string
    {
        return '<img' . $this->getAttributeString($this->attributes) . '>';
    }

}