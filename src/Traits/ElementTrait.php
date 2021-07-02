<?php

namespace SunnyFlail\Html\Traits;

use InvalidArgumentException;
use SunnyFlail\Html\Interfaces\IElement;

trait ElementTrait
{

    use AttributeTrait;

    /**
     * Sets elements attribute of provided name with provided value
     * 
     * @param string $attributeName Name of attribute to set
     * @param string|array|bool|int $value Value to set
     *
     * @throws InvalidArgumentException if used to set value
     * @return IElement
     */
    public function withAttribute(string $attributeName, string|array|bool|int $value): IElement
    {
        if ($attributeName === 'value') {
            if (method_exists($this, "withValue")) {
                throw new InvalidArgumentException(sprintf('Value should be set with method %s::withValue!', static::class));
            }
            throw new InvalidArgumentException(sprintf("Element %s doesn't use attribute value!", static::class));
        }
        $this->attributes[$attributeName] = $value;
        return $this;
    }

}