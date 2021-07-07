<?php

namespace SunnyFlail\Html\Traits;

use SunnyFlail\Html\Interfaces\IFieldElement;
use SunnyFlail\Html\Interfaces\IFormElement;

/**
 * Trait for Elements implementing IFieldElement interface
 */
trait FieldTrait
{
    /** @var IFormElement Reference to parent form elemetn */
    protected IFormElement $form;

    /** @var bool $valid */
    protected bool $valid;

    /** @var string|null $error Message that is shown if this field is invalid */
    protected ?string $error;

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