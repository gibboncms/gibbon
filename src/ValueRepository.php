<?php

namespace GibbonCms\Gibbon;

use GibbonCms\Gibbon\Interfaces\Repository as RepositoryInterface;
use Illuminate\Support\Arr;
use Symfony\Component\Yaml\Dumper as YamlDumper;
use Symfony\Component\Yaml\Parser as YamlParser;

class ValueRepository implements RepositoryInterface
{
    protected $filesystem;
    protected $filename;
    protected $values;

    /**
     * @param \GibbonCms\Gibbon\Interfaces\Filesystem $filesystem
     * @param string $filename
     */
    public function __construct(Filesystem $filesystem, $filename)
    {
        $this->filesystem = $filesystem;
        $this->filename = $filename;

        $this->yaml = new YamlParser;
        $this->yamlDumper = new YamlDumper;

        $this->parseFile();
    }

    /**
     * Find an entity by key (supports dot notation and defaults)
     *
     * @param string|null $key
     * @return mixed
     */
    public function find($key)
    {
        return Arr::get($this->values, $key);
    }

    /**
     * Return all entities
     * 
     * @return mixed[]
     */
    public function getAll()
    {
        return $this->find(null);
    }

    /**
     * Set an array item to a given value using "dot" notation.
     * If no key is given to the method, the entire array will be replaced.
     * 
     * Source: https://github.com/illuminate/support/blob/master/Arr.php
     *
     * @param string $key
     * @param mixed $value
     * @return array
     */
    public function set($key, $value)
    {
        return Arr::set($this->values, $key, $value);
    }

    /**
     * Persist the values
     * 
     * @return bool
     */
    public function save()
    {
        $encoded = $this->yamlDumper->dump($this->values, 8);

        return $this->filesystem->put($this->filename, $encoded);
    }

    /**
     * Parse the file and save the values in memory
     * 
     * @return void
     */
    protected function parseFile()
    {
        $this->values = $this->yaml->parse($this->getFile());
    }

    /**
     * Get the file contents
     * 
     * @return string
     */
    protected function getFile()
    {
        return $this->filesystem->read($this->filename);
    }
}
