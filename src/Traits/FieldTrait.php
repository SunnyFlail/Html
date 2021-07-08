<?php

namespace SunnyFlail\Html\Traits;

use SunnyFlail\Html\Interfaces\IFieldElement;
use SunnyFlail\Html\Interfaces\IFormElement;

/**
 * Trait for Elements implementing IFieldElement interface
 */
trait FieldTrait
{
    /**
     * @var IFormElement Reference to parent form
     */
    protected IFormElement $form;

    /**
     * @var bool $valid
     */
    protected bool $valid;

    /**
     * @var string|null $error Message that is shown if this field is invalid
     */
    protected ?string $error;

    /**
     * @var bool $required Bool indicating whether this field needs to be valid
     */
    protected bool $required;

    public function isValid(): bool
    {
        return $this->valid;
    }

    public function isRequired(): bool
    {
        return $this->required;
    }

    public function withError(string $error): IFieldElement
    {
        $this->error = $error;
        return $this;
    }

    public function withForm(IFormElement $form): IFieldElement
    {
        $this->form = $form;
        return $this;
    }

}