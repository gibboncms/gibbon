<?php

namespace GibbonCms\Gibbon\Core;

use GibbonCms\Gibbon\System\Cache;
use GibbonCms\Gibbon\System\CacheOptions;

class JsonCacheOptions implements CacheOptions
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
