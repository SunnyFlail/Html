<?php

namespace SunnyFlail\HtmlAbstraction\Elements;

use SunnyFlail\HtmlAbstraction\Interfaces\IElement;

final class TextNodeElement implements IElement
{

    public function __construct(private string $text) {}

    public function __toString()
    {
        return $this->text;
    }

}