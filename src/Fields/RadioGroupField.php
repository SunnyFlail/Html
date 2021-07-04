<?php

namespace SunnyFlail\Html\Fields;

use SunnyFlail\Html\Elements\CheckableElement;
use SunnyFlail\Html\Elements\ContainerElement;
use SunnyFlail\Html\Elements\LabelElement;
use SunnyFlail\Html\Elements\NodeElement;
use SunnyFlail\Html\Interfaces\IElement;
use SunnyFlail\Html\Interfaces\IFormElement;
use SunnyFlail\Html\Interfaces\ISelectableField;
use SunnyFlail\Html\Traits\ContainerElementTrait;
use SunnyFlail\Html\Traits\FieldTrait;
use SunnyFlail\Html\Traits\SelectableTrait;

final class RadioGroupField implements ISelectableField
{
    use ContainerElementTrait, FieldTrait, SelectableTrait;

    protected IFormElement $form;
    protected ?string $error;
    protected bool $valid;

    public function __construct(
        protected string $name,
        protected array $options,
        protected array $inputAttributes = [],
        protected array $wrapperAttributes = [],
        protected array $labelAttributes = [],
        array $nestedElements = []
    )
    {
        $this->nestedElements = $nestedElements;
    }

    public function resolve(array $values): bool
    {
        $value = $values[$this->name] ?? null;

        if (in_array($value, $this->optons)) {
            $this->value = $value;
            $this->valid = true;
        }

        return $this->valid;
    }

    public function getInputElement(): IElement
    {
        $inputs = [];
        $name = $this->getFullName();

        foreach ($this->options as $label => $value) {
            if (is_numeric($label)) {
                $label = $value;
            }
            $checked = $this->value === $value;

            $inputs[] = new LabelElement(
                labelText: $label,
                attributes: $this->labelAttributes,
                nestedElements: [
                    new CheckableElement(
                        name: $name,
                        radio: true,
                        checked: $checked,
                        attributes: $this->inputAttributes
                    )
                ]
            );
        }

        return new NodeElement($inputs);
    }

    public function __toString(): string
    {
        return new ContainerElement(
            attributes: $this->containerAttributes,
            nestedElements: [$this->getInputElement()]
        );
    }
    
}