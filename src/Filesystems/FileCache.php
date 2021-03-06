<?php

namespace GibbonCms\Gibbon\Filesystems;

class FileCache implements Cache
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
     * Constructor method
     * 
     * @param  string $file
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
     * @param  string $key
     * @return mixed
     */
    public function get($key)
    {
        return isset($this->data[$key]) ? $this->data[$key] : null;
    }

    /**
     * Place an object in the cache
     * 
     * @param  string $key
     * @param  mixed $value
     * @return void
     */
    public function put($key, $value)
    {
        $this->data[$key] = $value;
    }

    /**
     * Forget an object in the cache
     * 
     * @param  string $key
     * @return void
     */
    public function forget($key)
    {
        unset($this->data[$key]);
    }

    /**
     * Empty the cache
     * 
     * @return void
     */
    public function clear()
    {
        $this->data = [];
    }

    /**
     * Persist the cache data
     * 
     * @return bool
     */
    public function persist()
    {
        $parts = explode('/', $this->file);
        array_pop($parts);

        $dir = implode('/', $parts);

        if (!is_dir($dir)) {
            mkdir($dir, 493, true);
        }

        return file_put_contents($this->file, serialize($this->data));
    }

    /**
     * Try to unserialize the existing cache, if it's corrupted, it's lost, let it go.
     * 
     * @return bool
     */
    public function rebuild()
    {
        if (file_exists($this->file)) {
            try {
                $this->data = unserialize(file_get_contents($this->file));
                return true;
            } catch (\Exception $e) {
                // Try just used to suppress the exception. If the cache is corrupted we just start from scratch.
            }
        }

        $this->data = [];
        $this->persist();
        return false;
    }
}
