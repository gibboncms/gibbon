<?php

namespace GibbonCms\Gibbon\Exceptions;

class ModuleDoesntExistException extends \Exception
{
    public function __construct($moduleName)
    {
        $message = "Module $moduleName doesn't exist";

        parent::__construct($message);
    }
}
