<?php

namespace GibbonCms\Gibbon\Core;

use GibbonCms\Gibbon\System\Repository;
use GibbonCms\Gibbon\System\RepositoryOptions;

class JsonRepositoryOptions implements RepositoryOptions
{
    protected $filename;
    
    public function __construct($filename)
    {
        $this->filename = $filename;
    }

    public function filename()
    {
        return $this->filename;
    }
}
