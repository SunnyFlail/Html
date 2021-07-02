<?php

namespace SunnyFlail\Html\Traits;

trait AttributeTrait
{
    /**
     * Formats the attributes as a valid html attributes
     * 
     * @param mixed[] $attributes Attributes to stringify
     * 
     * @return string
     */
    protected function getAttributeString(array $attributes): string
    {
        $str = '';
        foreach ($attributes as $name => $value) {
            if (empty($value) && $value !== 0) {
                continue;
            }
            if (is_array($value)) {
                $value = implode(' ', $value);
            }
            if (is_bool($value)) {
                $str .= ' ' . $name;
                continue;
            }
            $str .= ' ' . $name . '="' . $value . '"'; 
        }

        return $str;
    }
}