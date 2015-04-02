<?php

namespace GibbonCms\Gibbon\Core;

use GibbonCms\Gibbon\System\Repository;
use GibbonCms\Gibbon\System\RepositoryOptions;
use League\Flysystem\AdapterInterface;

class FileRepositoryOptions implements RepositoryOptions
{
    protected $adapter;
    
    public function __construct(AdapterInterface $adapter, Repository $cache)
    {
        $this->adapter = $adapter;
        $this->cache = $cache;
    }

    public function adapter()
    {
        return $this->adapter;
    }
}