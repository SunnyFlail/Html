<?php

namespace SunnyFlail\Html\Interfaces;

use Psr\Http\Message\ServerRequestInterface;

/**
 * Basic interfacece for Forms
 */
interface IFormElement extends IElement
{
    
    public function getName(): string;

    /**
     * Resolves the form
     * 
     * @return bool If provided values fit in with 
     */
    public function resolveForm(ServerRequestInterface $request): bool;

    /**
     * Basic function called during setup of the form
     */
    public function withFields(IFieldElement ...$fields);

}