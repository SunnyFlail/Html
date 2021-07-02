<?php

namespace SunnyFlail\Html\Elements;

use SunnyFlail\Html\Interfaces\IElement;

final class TextNodeElement implements IElement
{

    public function __construct(private string $text) {}

    public function __toString()
    {
        return $this->text;
    }

}