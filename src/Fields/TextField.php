<?php

namespace SunnyFlail\Html\Fields;

use SunnyFlail\Html\Constraints\EmailConstraint;
use SunnyFlail\Html\Elements\ContainerElement;
use SunnyFlail\Html\Elements\EmailElement;
use SunnyFlail\Html\Elements\InputElement;
use SunnyFlail\Html\Elements\LabelElement;
use SunnyFlail\Html\Interfaces\IElement;
use SunnyFlail\Html\Traits\RenderFieldTrait;

final class TextField extends AbstractInputField
{

    public function __construct(
        string $name = "text",
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
            nestedElements: $nestedElements
        );

        $this->constraints = [];
    }

    public function getInputElement(): IElement
    {
        return new InputElement(
            name: $this->getFullName(),
            attributes: $this->inputAttributes
        );
    }

}