<?php

namespace SunnyFlail\Html\Fields;

use SunnyFlail\Html\Elements\BlockElement;
use SunnyFlail\Html\Elements\LabelElement;
use SunnyFlail\Html\Elements\TextNodeElement;
use SunnyFlail\Html\Interfaces\IFieldElement;
use SunnyFlail\Html\Interfaces\IFormElement;
use SunnyFlail\Html\Interfaces\IConstraint;
use SunnyFlail\Html\Interfaces\IElement;
use SunnyFlail\Html\Traits\ContainerElementTrait;
use SunnyFlail\Html\Traits\AttributeTrait;
use SunnyFlail\Html\InvalidFieldException;

abstract class AbstractInputField implements IFieldElement
{

    use ContainerElementTrait;
    
    protected IFormElement $form;
    protected bool $valid;
    /** @var IConstraint[] $constraints */
    protected array $constraints;
    /** @var mixed $value */
    protected $value;
    /** @var string|null $error Message that is shown if this field is invalid */
    protected ?string $error;

    /**
     * 
     * @param string $name Name of the field
     * @param bool $required
     * @param array $attributes Attributes to be pa
     * @param string[] $errorMessages Array containing error messages
     * Indexes MUST be numeric strings
     * Index "-1" Is for message shown if no value was provided for a required field 
     */
    public function __construct(
        protected string $name,
        protected bool $required = true,
        protected array $errorMessages = [],
        protected array $wrapperAttributes = [],
        protected array $errorAttributes = [],
        protected ?string $labelText = null,
        protected array $labelAttributes = [],
        array $nestedElements = []
    ) {
        $this->error = null;
        $this->valid = false;
        $this->nestedElements = $nestedElements;
    }

    public function isValid(): bool
    {
        return $this->valid;
    }

    public function isRequired(): bool
    {
        return $this->required;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getValue()
    {
        if (!$this->valid && $this->isRequired()) {
            throw new InvalidFieldException(
                sprintf("Tried to get value of an invalid field %s with name %s!", static::class, $this->name)
            );
        }

        return $this->value;
    }

    public function getFullName(): string
    {
        return $this->form->getName() . '[' . $this->name . ']';
    }

    public function getId(): string
    {
        return $this->form->getName() . "-"  . $this->name;
    }

    public function withForm(IFormElement $form): IFieldElement
    {
        $this->form = $form;
        return $this;
    }

    public function resolve(array $values): bool
    {
        $value = $values[$this->getFullName()] ?? null;
        if ($value === null){
            if ($this->isRequired()) {
                $this->error = $this->errorMessages["-1"] ?? "No value provided for field $this->name!";
            }
            return false;
        }

        foreach ($this->constraints as $index => $constraint) {
            if (false === $constraint->formValueValid($value)) {
                $this->error = $this->errorMessages["$index"] ?? "Provided value doesn't fit the constraints!";
                return false;
            }
        }

        $this->withValue($value);
        return $this->valid = true;
    }

    public function withValue($value): IFieldElement
    {
        $this->value = $value;
        return $this;
    }

    public function withError(string $error): IFieldElement
    {
        $this->error = $error;
        return $this;
    }

    public function __toString(): string
    {
        $inputId = $this->getId();
        $elements = [
            new LabelElement(
                for: $inputId,
                attributes: $this->labelAttributes,
                labelText: $this->labelText ?? $this->name
            ),
            $this->getInputElement()
        ];

        if ($this->error) {
            $elements[] = new BlockElement(
                $this->errorAttributes,
                [new TextNodeElement($this->error)]
            );
        }
        
        $elements = [...$elements, ...$this->nestedElements];

        return new BlockElement($this->wrapperAttributes, $elements);
    }


}