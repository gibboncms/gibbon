<?php

namespace GibbonCms\Gibbon\Interfaces;

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
     * Empty the cache
     * 
     * @return void
     */
    public function flush();

    /**
     * Start a cache transaction
     * 
     * @return void
     */
    public function startTransaction();

    /**
     * Commit a cache transaction
     * 
     * @return bool
     */
    public function commitTransaction();

    /**
     * Cancel a cache transaction
     * 
     * @return bool
     */
    public function cancelTransaction();
}
