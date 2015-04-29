<?php

namespace GibbonCms\Gibbon;

use Stash\Driver\FileSystem as Driver;
use Stash\Pool;
use GibbonCms\Gibbon\Interfaces\Cache as CacheInterface;

class Cache implements CacheInterface
{
    /**
     * The stash pool
     * 
     * @var \Stash\Pool
     */
    private $pool;

    /**
     * Constructor method
     * 
     * @param string $path
     */
    public function __construct($path)
    {
        $driver = new Driver;
        $driver->setOptions(['path' => $path]);
        $this->pool = new Pool($driver);
    }

    /**
     * Get an object from the cache
     * 
     * @param string $key
     * @return mixed
     */
    public function get($key)
    {
        return $this->pool->getItem($key)->get();
    }

    /**
     * Place an object in the cache
     * 
     * @param string $key
     * @param mixed $value
     * @return void
     */
    public function place($key, $value)
    {
        $this->pool->getItem($key)->set($value);
    }

    /**
     * Empty the cache
     * 
     * @return void
     */
    public function flush()
    {
        $this->pool->flush();
    }
}
