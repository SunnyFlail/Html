<?php

namespace SunnyFlail\Html\Interfaces;

interface ISelectableField extends IInputField
{

    public function withOptions(array $options): ISelectableField;

}