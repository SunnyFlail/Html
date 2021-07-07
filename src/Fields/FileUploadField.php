<?php

namespace SunnyFlail\Html\Fields;

use SunnyFlail\Html\Elements\ContainerElement;
use SunnyFlail\Html\Elements\FileElement;
use SunnyFlail\Html\Elements\LabelElement;
use SunnyFlail\Html\Interfaces\IFieldElement;
use SunnyFlail\Html\Interfaces\IFileField;
use SunnyFlail\Html\Interfaces\IInputField;
use SunnyFlail\Html\Traits\FieldTrait;
use SunnyFlail\Html\Traits\InputFieldTrait;

final class FileUploadField implements IInputField, IFileField
{
    
    use InputFieldTrait, FieldTrait;

    public function __construct(
        string $name
    ) {
        $this->name = $name;
    }

    public function resolve(array $params)
    {

    }

    public function __toString(): string
    {
        $inputId = $this->getInputId();

        return new ContainerElement(
            attributes: $this->containerAttributes,
            nestedElements: [
                new LabelElement(
                    for: $inputId,
                    labelText: $this->labelText,
                    attributes: $this->labelAttributes
                ),
                new FileElement(
                    name: $this->getFullName(),
                    id: $inputId,
                    acceptedMimeTypes: $this->acceptedTypes,
                    multiple: $this->multiple,
                    attributes: $this->inputAttributes
                )
            ]
        );
    }

}