<?php

namespace SunnyFlail\Html\Elements;

final class LabelElement extends AbstractContainerElement
{

    public function __construct(
        string $for,
        ?string $labelText = null,
        array $attributes = [],
        array $nestedElements = []
    )
    {
        $attributes["for"] = $for;

        if ($labelText) {
            $nestedElements[] = new TextNodeElement($labelText);
        }

        parent::__construct(
            tag: "label",
            attributes: $attributes,
            nestedElements: $nestedElements
        );
    }


}