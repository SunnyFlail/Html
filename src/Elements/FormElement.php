<?php

namespace SunnyFlail\Html\Elements;

use SunnyFlail\Html\Interfaces\IFieldElement;
use SunnyFlail\Html\Interfaces\IFileField;
use SunnyFlail\Html\Interfaces\IFormElement;
use Psr\Http\Message\ServerRequestInterface;
use ReflectionClass;
use SunnyFlail\Html\Exceptions\InvalidFormException;
use SunnyFlail\Html\Traits\AttributeTrait;

/**
 * Abstraction over html forms with HTTP parameter resolving
 */
abstract class FormElement implements IFormElement
{

    use AttributeTrait;
    
    /**
     * @var IFieldElement $fields
     */
    protected array $fields;
    
    protected array $attributes;

    protected bool $initialised;

    protected string $formMethod;

    protected string $formName;

    public function __construct(
        ?string $formName = null,
        bool $useHtmlValidation = true,
        array $attributes = [],
        protected string $buttonText = "Submit",
        protected array $buttonAttributes = [],
        protected array $buttonElements = []
    ) {
        $attributes["novalidate"] = $useHtmlValidation;
        $this->attributes = $attributes;

        $this->formName = $formName ?? lcfirst(
            (new ReflectionClass(static::class))->getShortName()
        );

    }

    public function getName(): string
    {
        return $this->formName;
    }

    public function resolveForm(ServerRequestInterface $request): bool
    {
        $requestMethod = $request->getMethod();

        if ((
                $this->formMethod === "POST"
                && $requestMethod === "POST"
                && $params = $request->getParsedBody()
            ) || (
                $this->formMethod === "GET"
                && $requestMethod === "GET"
                && $params = $request->getQueryParams()
        )) {
            if (is_array($params) && isset($params[$this->formName])) {
                $valid = true;

                foreach ($this->fields as $field) {
                    if ($field instanceof IFileField) {
                        $field->checkFiles($request->getUploadedFiles());
                        continue;
                    }
                    $field->resolve($params);
                }

                $valid = array_reduce(
                    $this->fields,
                    function(bool $valid, IFieldElement $field) {
                        if (false === $field->isValid() && $field->isRequired()) {
                            $valid = false;
                        }
                        return $valid;
                    },
                    true
                );
            }
        }

        return $valid ?? null;
    }

    public function withFields(IFieldElement ...$fields): IFormElement
    {
        $this->fields = $fields;
        $this->initialised = true;

        return $this;
    }

    /**
     * Returns a html string representation of form
     * 
     * You may define another method of rendering for your form by defining public/protected method render
     * 
     * @return string
     */
    public function __toString(): string
    {
        if (!$this->initialised) {
            throw new InvalidFormException(sprintf(
                "Form %s with name %s isn't initalised!",
                static::class,
                $this->getName()
            ));
        }

        if (method_exists(static::class, "render")) {
            return $this->render();
        }

        $attributes = $this->attributes;
        $attributes['id'] = $attributes['id'] ?? $this->formName;
        $attributes['method'] = $this->formMethod;

        $elements = $this->fields;
        $elements[] = new ButtonElement(
            type: "submit",
            attributes: $this->buttonAttributes,
            text: $this->buttonText,
            nestedElements: $this->buttonElements
        );

        return '<form' . $this->getAttributeString($attributes) . '>' . implode('', $elements) . '</form>';
    }

}
