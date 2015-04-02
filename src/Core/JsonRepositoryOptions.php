<?php

namespace GibbonCms\Gibbon\Core;

use GibbonCms\Gibbon\System\Repository;
use GibbonCms\Gibbon\System\RepositoryOptions;

class JsonRepositoryOptions implements RepositoryOptions
{
    protected $source;
    
    public function __construct($source)
    {
        $this->source = $source;
    }

    public function source()
    {
        return $this->source;
    }
}
