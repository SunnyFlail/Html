<?php

namespace SunnyFlail\Html\Fields;

use SunnyFlail\Html\Constraints\EmailConstraint;
use SunnyFlail\Html\Elements\EmailElement;
use SunnyFlail\Html\Elements\InputElement;
use SunnyFlail\Html\Interfaces\IElement;

final class EmailField extends AbstractInputField
{

    public function __construct(
        string $name = "email",
        bool $required = true,
        array $errorMessages = [],
        protected array $inputAttributes = [],
        array $wrapperAttributes = [],
        array $errorAttributes = [],
        ?string $labelText = null,
        array $labelAttributes = [],
        array $nestedElements = []
    ) {
        parent::__construct(
            name: $name,
            required: $required,
            errorMessages: $errorMessages,
            wrapperAttributes: $wrapperAttributes,
            errorAttributes: $errorAttributes,
            labelText: $labelText,
            labelAttributes: $labelAttributes,
            nestedElements: $nestedElements,
            constraints: [new EmailConstraint()]
        );
    }

    public function getInputElement(): IElement
    {
        $attributes = $this->inputAttributes;
        $attributes['minlength'] = 5;
        $attributes['maxlength'] = 254;

        return new InputElement(
            id: $this->getInputId(),
            type: 'email',
            name: $this->name,
            attributes: $attributes
        );
    }

}