<?php

namespace SunnyFlail\Html\Interfaces;

use Psr\Http\Message\ServerRequestInterface;

/**
 * Basic interfacece for Forms
 */
interface IFormElement extends IElement
{
    /**
     * Returns the name of the form
     * 
     * @return string
     */
    public function getName(): string;

    /**
     * Resolves the form
     * 
     * @return bool
     */
    public function resolveForm(ServerRequestInterface $request): bool;

    /**
     * The main initalisation method
     * 
     * @return IFormElement $this
     */
    public function withFields(IFieldElement ...$fields): IFormElement;

}