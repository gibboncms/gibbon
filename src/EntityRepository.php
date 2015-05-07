<?php

namespace GibbonCms\Gibbon;

use GibbonCms\Gibbon\Interfaces\Factory as FactoryInterface;
use GibbonCms\Gibbon\Interfaces\Repository;

class EntityRepository implements Repository
{
    /**
     * The filesystem is used to read and write files
     * 
     * @var \GibbonCms\Gibbon\Interfaces\Filesystem
     */
    protected $filesystem;

    /**
     * We're using a cache because file io is slow
     * 
     * @var \GibbonCms\Gibbon\Interfaces\Cache
     */
    protected $cache;

    /**
     * The entity factory transforms raw data to a usable entity
     * 
     * @var \GibbonCms\Gibbon\Interfaces\FactoryInterface
     */
    protected $factory;

    /**
     * Constructor method injects all dependencies
     * 
     * @param \GibbonCms\Gibbon\Interfaces\Filesystem $filesystem
     * @param \GibbonCms\Gibbon\Interfaces\Cache $cache
     * @param \GibbonCms\Gibbon\Interfaces\FactoryInterface $factory
     */
    public function __construct(Filesystem $filesystem, Cache $cache, FactoryInterface $factory)
    {
        $this->filesystem = $filesystem;
        $this->factory = $factory;
        $this->cache = $cache;

        $this->cache->rebuild();
    }

    /**
     * Find an entity by id
     * 
     * @param mixed $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->cache->get($id);
    }

    /**
     * Return all entities
     * 
     * @return mixed[]
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
    public function buildCache()
    {
        $files = $this->filesystem->listFiles();

        $this->cache->clear();

        foreach ($files as $file) {
            $entity = $this->parseFile($file);
            if ($entity != null) $this->cache->put($entity->getId(), $entity);
        }
        
        $this->cache->persist();
    }

    /**
     * @param array $file
     * @return mixed|null
     */
    protected function parseFile($file)
    {
        if ($file['extension'] == 'md') {
            $parts = explode('-', $file['filename'], 2);

            $parsedFilename = [
                'id'   => $parts[0],
                'slug' => $parts[1],
            ];

            $entity = $this->factory->make([
                'id'   => $parsedFilename['id'],
                'slug' => $parsedFilename['slug'],
                'data' => $this->filesystem->read($file['path']),
            ]);
            
            return $entity;
        }
    }
}
