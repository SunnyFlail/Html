<?php

namespace SunnyFlail\Html\Fields;

use SunnyFlail\Html\Constraints\EmailConstraint;
use SunnyFlail\Html\Elements\BlockElement;
use SunnyFlail\Html\Elements\ButtonElement;
use SunnyFlail\Html\Elements\PasswordElement;
use SunnyFlail\Html\Interfaces\IElement;
use SunnyFlail\Html\Traits\RenderFieldTrait;

final class PasswordField extends AbstractInputField
{

    public function __construct(
        string $name = "password",
        bool $required = true,
        array $errorMessages = [],
        protected bool $withPeeper = true,
        protected array $peeperAttributes = [],
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

        if ($this->withPeeper) {
            $this->peeperAttributes["data-button-type"] = "peeper";
        }

        $this->constraints = [new EmailConstraint()];
    }

    public function getInputElement(): IElement
    {
        if ($this->withPeeper) {
            return new BlockElement(
                [
                    "style" => "position: relative;"
                ],
                [
                    new PasswordElement(
                        name: $this->name,
                        attributes: $this->inputAttributes
                    ),
                    new ButtonElement(
                        type: "button",
                        attributes: $this->peeperAttributes
                    )
                ]
            );
        }

        return new PasswordElement(
            name: $this->name,
            attributes: $this->inputAttributes
        );
    }

}