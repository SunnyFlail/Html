<?php

namespace SunnyFlail\Html\Fields;

use Psr\Http\Message\UploadedFileInterface;
use SunnyFlail\Html\Elements\ContainerElement;
use SunnyFlail\Html\Elements\LabelElement;
use SunnyFlail\Html\Elements\FileElement;
use SunnyFlail\Html\Interfaces\IFileConstraint;
use SunnyFlail\Html\Interfaces\IInputField;
use SunnyFlail\Html\Interfaces\IFileField;
use SunnyFlail\Html\Traits\InputFieldTrait;
use SunnyFlail\Html\Traits\FieldTrait;

final class FileUploadField implements IInputField, IFileField
{
    
    use InputFieldTrait, FieldTrait;

    /**
     * @param IFileConstraint[] $constraints
     * */
    public function __construct(
        string $name,
        bool $required = true,
        protected bool $multiple = true,
        protected array $containerAttributes = [],
        protected array $labelAttributes = [],
        protected ?string $labelText = null,
        protected array $inputAttributes = [],
        protected bool $terminateOnError = false,
        array $errorMessages = [],
        protected array $constraints = []
    ) {
        $this->valid = false;
        $this->error = null;
        $this->name = $name;
        $this->required = $required;
        $this->errorMessages = $errorMessages;
    }

    public function resolve(array $params): bool
    {
        /** @var UploadedFileInterface[] $files */
        $files = $params[$this->getFullName()];

        if ($this->required && !$files) {
            $this->error = $this->resolveErrorMessage("-1");
            return false;
        }

        $incorrectFiles = [];

        foreach ($this->constraints as $errorKey => $constraint) {
            foreach ($files as $fileKey => $file) {
                /** Skip incorrect files */
                if (array_key_exists($fileKey, $incorrectFiles)) {
                    continue;
                }

                if (!$constraint->fileValid($file)) {
                    $this->error = $this->resolveErrorMessage("$errorKey");

                    if ($this->terminateOnError) {
                        return false;
                    }

                    $incorrectFiles[$fileKey] = true;
                    continue;
                }
            }
        }
        $this->values = array_diff_key(
            $files, $incorrectFiles
        );

        return $this->valid = true;
    }

    public function resolveErrorMessage(string $code): string
    {
        if (!isset($this->errorMessages[$code])) {
            switch ($code) {
                case "-1":
                    return "No files were uploaded!";
                default:
                    return "One or more of uploaded files doesn't match constraints!";
            }
        }

        return $this->errorMessages[$code];
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
                    multiple: $this->multiple,
                    attributes: $this->inputAttributes
                )
            ]
        );
    }

}