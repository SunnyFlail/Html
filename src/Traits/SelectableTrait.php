<?php

namespace SunnyFlail\Html\Traits;

use SunnyFlail\Html\Interfaces\ISelectableField;

/**
 * Trait for classes implementing ISelectableField interface
 */
trait SelectableTrait
{

    public function withOptions(array $options): ISelectableField
    {
        $this->options = $options;
        return $this;
    }
    
}