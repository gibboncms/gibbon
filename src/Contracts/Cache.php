<?php

namespace GibbonCms\Gibbon\Contracts;

interface Cache
{
    /**
     * Get an object from the cache
     * 
     * @param string $key
     * @return mixed
     */
    public function get($key);

    /**
     * Place an object in the cache
     * 
     * @param string $key
     * @param mixed $value
     * @return void
     */
    public function place($key, $value);

    /**
     * Empty the cache
     * 
     * @return void
     */
    public function flush();
}
