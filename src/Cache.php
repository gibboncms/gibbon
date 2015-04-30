<?php

namespace GibbonCms\Gibbon;

use GibbonCms\Gibbon\Interfaces\Cache as CacheInterface;

class Cache implements CacheInterface
{
    /**
     * The cache's filename
     * 
     * @var string
     */
    protected $file;

    /**
     * The cache data
     * 
     * @var array
     */
    protected $data;

    /**
     * Determines whether the cache is currently transacting
     * 
     * @var bool
     */
    protected $transacting = false;

    /**
     * Constructor method
     * 
     * @param string $directory
     */
    public function __construct($file)
    {
        $this->file = $file;

        $this->data = [];
    }

    /**
     * Get all data from the cache
     * 
     * @return array
     */
    public function all()
    {
        return $this->data;
    }

    /**
     * Get an object from the cache
     * 
     * @param string $key
     * @return mixed
     */
    public function get($key)
    {
        return isset($this->data[$key]) ? $this->data[$key] : null;
    }

    /**
     * Place an object in the cache
     * 
     * @param string $key
     * @param mixed $value
     * @return void
     */
    public function put($key, $value)
    {
        $this->data[$key] = $value;
        $this->save();
    }

    /**
     * Empty the cache
     * 
     * @return void
     */
    public function flush()
    {
        $this->data = [];
        $this->save();
    }

    /**
     * Start a cache transaction
     * 
     * @return void
     */
    public function startTransaction()
    {
        $this->transacting = true;
    }

    /**
     * Commit a cache transaction
     * 
     * @return bool
     */
    public function commitTransaction()
    {
        $this->transacting = false;
        $this->save();
    }

    /**
     * Cancel a cache transaction
     * 
     * @return bool
     */
    public function cancelTransaction()
    {
        $this->transacting = false;
        $this->rebuild();
    }

    /**
     * Persist the cache data
     * 
     * @return bool
     */
    protected function save()
    {
        if ($this->transacting) {
            return false;
        }

        return file_put_contents($this->file, serialize($this->data));
    }

    /**
     * Try to unserialize the existing cache, if it's corrupted, it's lost, let it go.
     * 
     * @return bool
     */
    protected function rebuild()
    {
        if (file_exists($this->file)) {
            try {
                $this->data = unserialize(file_get_contents($this->file));
                return true;
            } catch (\Exception $e) { }
        }

        $this->data = [];
        $this->save();
        return false;
    }
}
