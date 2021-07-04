<?php

namespace SunnyFlail\Html\Traits;

use SunnyFlail\Html\Interfaces\ISelectableField;

trait SelectableTrait
{

    public function withOptions(array $options): ISelectableField
    {
        $this->options = $options;
        return $this;
    }
    
}