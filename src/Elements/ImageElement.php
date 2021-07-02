<?php

namespace SunnyFlail\Html\Elements;

use SunnyFlail\Html\Interfaces\IElement;
use SunnyFlail\Html\Traits\ElementTrait;

final class ImageElement implements IElement
{

    use ElementTrait;

    public function __construct(
        string $src,
        ?string $alt = null,
        array $attributes = []
    ) {
        $attributes["src"] = $src;
        $this->attributes = $attributes;
    }

    public function __toString(): string
    {
        return '<img' . $this->getAttributeString($this->attributes) . '>';
    }

}