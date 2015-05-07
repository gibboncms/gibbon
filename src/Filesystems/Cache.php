<?php

namespace GibbonCms\Gibbon\Filesystems;

interface Cache
{
    /**
     * Get all data from the cache
     * 
     * @return array
     */
    public function all();

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
    public function put($key, $value);

    /**
     * Forget an object in the cache
     * 
     * @param string $key
     * @return void
     */
    public function forget($key);

    /**
     * Empty the cache
     * 
     * @return void
     */
    public function clear();

    /**
     * Persist the cache
     * 
     * @return void
     */
    public function persist();
}
