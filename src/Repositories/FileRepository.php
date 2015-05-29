<?php

namespace GibbonCms\Gibbon\Repositories;

use GibbonCms\Gibbon\Factories\Factory;
use GibbonCms\Gibbon\Filesystems\Cache;
use GibbonCms\Gibbon\Filesystems\Filesystem;

class FileRepository implements Repository
{
    /**
     * The filesystem is used to read and write files
     * 
     * @var \GibbonCms\Gibbon\Filesystems\Filesystem
     */
    protected $filesystem;

    /**
     * We're using a cache because file io is slow
     * 
     * @var \GibbonCms\Gibbon\Filesystems\Cache
     */
    protected $cache;

    /**
     * The entity factory transforms raw data to a usable entity
     * 
     * @var \GibbonCms\Gibbon\Factories\Factory
     */
    protected $factory;

    /**
     * Constructor method injects all dependencies
     * 
     * @param  \GibbonCms\Gibbon\Filesystems\Filesystem $filesystem
     * @param  string $directory
     * @param  \GibbonCms\Gibbon\Filesystems\Cache $cache
     * @param  \GibbonCms\Gibbon\Factories\Factory $factory
     */
    public function __construct(Filesystem $filesystem, $directory, Cache $cache, Factory $factory)
    {
        $this->filesystem = $filesystem;
        $this->directory = $directory;
        $this->factory = $factory;
        $this->cache = $cache;

        $this->cache->rebuild();
    }

    /**
     * Find an entity by id
     * 
     * @param string $id
     * @return \GibbonCms\Gibbon\Entities\Entity
     */
    public function find($id)
    {
        return $this->cache->get($id);
    }

    /**
     * Return all entities
     * 
     * @return \GibbonCms\Gibbon\Entities\Entity[]
     */
    public function getAll()
    {
        return array_values($this->cache->all());
    }

    /**
     * Build the cache
     * 
     * @return void
     */
    public function build()
    {
        $files = $this->filesystem->listFiles($this->directory);

        $this->cache->clear();

        foreach ($files as $file) {
            $entity = $this->parseFile($file);
            if ($entity != null) $this->cache->put($entity->getIdentifier(), $entity);
        }
        
        $this->cache->persist();
    }

    /**
     * @param array $file
     * @return \GibbonCms\Gibbon\Entities\Entity|null
     */
    protected function parseFile($file)
    {
        if ($file['extension'] != 'md') {
            return null;
        }

        $entity = $this->factory->make([
            'id'   => $file['filename'],
            'data' => $this->filesystem->read($file['path']),
        ]);
        
        return $entity;
    }
}
