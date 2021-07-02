<?php

namespace SunnyFlail\Html\Interfaces;

use Psr\Http\Message\UploadedFileInterface;

interface IFileField extends IFieldElement
{

    /**
     * Checks whether uploaded files fullfill imposed constraints
     * 
     * @var UploadedFileInterface[] $files
     * 
     */
    public function checkFiles(array $files);

}