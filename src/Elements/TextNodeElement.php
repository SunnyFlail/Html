<?php

namespace SunnyFlail\HtmlAbstraction\Elements;

use SunnyFlail\HtmlAbstraction\Interfaces\IElement;

final class TextNodeElement implements IElement
{
    private string $text;
    
    public function __construct(string $text) {
        $this->text = $text;
    }

    public function __toString()
    {
        return $this->text;
    }

}