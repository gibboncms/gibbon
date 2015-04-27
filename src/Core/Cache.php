<?php

namespace GibbonCms\Gibbon\Core;

use Stash\Driver\FileSystem as Driver;
use Stash\Pool;
use GibbonCms\Gibbon\Core\Contracts\Cache as CacheContract;

class Cache implements CacheContract
{
    private $pool;

    public function __construct($path)
    {
        $driver = new Driver;
        $driver->setOptions(['path' => $path]);
        $this->pool = new Pool($driver);
    }

    public function get($key)
    {
        return $this->pool->getItem($key)->get();
    }

    public function set($key, $value)
    {
        $this->pool->getItem($key)->set($value);
    }

    public function flush()
    {
        $this->pool->flush();
    }
}
