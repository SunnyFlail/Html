<?php

namespace SunnyFlail\Html\Interfaces;

use Psr\Http\Message\UploadedFileInterface;

interface IFileConstraint
{

    public function fileValid(UploadedFileInterface $file): bool;

}