<?php

namespace SunnyFlail\Html\Fields;

use SunnyFlail\Html\Elements\ContainerElement;
use SunnyFlail\Html\Elements\LabelElement;
use SunnyFlail\Html\Elements\TextNodeElement;
use SunnyFlail\Html\Interfaces\IConstraint;
use SunnyFlail\Html\Interfaces\IElement;
use SunnyFlail\Html\Interfaces\IInputField;
use SunnyFlail\Html\Traits\ContainerElementTrait;
use SunnyFlail\Html\Traits\FieldTrait;
use SunnyFlail\Html\Traits\InputFieldTrait;

abstract class AbstractInputField implements IInputField
{

    use ContainerElementTrait, FieldTrait, InputFieldTrait;

    /**
     * @param string $name Name of the field
     * @param bool $required
     * @param array $attributes Attributes to be pa
     * @param string[] $errorMessages Array containing error messages
     * Indexes MUST be numeric strings
     * Index "-1" Is for message shown if no value was provided for a required field 
     * @param IConstraint[] $constraints
     */
    public function __construct(
        protected string $name,
        protected bool $required = true,
        protected array $errorMessages = [],
        protected array $wrapperAttributes = [],
        protected array $errorAttributes = [],
        protected ?string $labelText = null,
        protected array $labelAttributes = [],
        protected array $nestedElements = [],
        protected array $constraints = []
    ) {
        $this->error = null;
        $this->value = null;
        $this->valid = false;
    }

    public function resolve(array $values): bool
    {
        $value = $values[$this->getFullName()] ?? null;

        if ($value === null){
            if ($this->isRequired()) {
                $this->error = $this->resolveErrorMessage("-1");
            }
            return false;
        }

        foreach ($this->constraints as $index => $constraint) {
            if (false === $constraint->formValueValid($value)) {
                $this->error = $this->resolveErrorMessage("$index");
                return false;
            }
        }

        $this->withValue($value);
        return $this->valid = true;
    }

    public function __toString(): string
    {
        $inputId = $this->getInputId();
        $elements = [
            new LabelElement(
                for: $inputId,
                attributes: $this->labelAttributes,
                labelText: $this->labelText ?? $this->name
            ),
            $this->getInputElement()
        ];

        if ($this->error) {
            $elements[] = new ContainerElement(
                attributes: $this->errorAttributes,
                nestedElements: [new TextNodeElement($this->error)]
            );
        }
        
        $elements = [...$elements, ...$this->nestedElements];

        return new ContainerElement(
            attributes: $this->wrapperAttributes,
            nestedElements: $elements
        );
    }
     
    /**
     * Returns the input element / node containing input elements
     * 
     * @return IElement
     */
    abstract public function getInputElement(): IElement;

}