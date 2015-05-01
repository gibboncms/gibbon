<?php

namespace GibbonCms\Gibbon;

use GibbonCms\Gibbon\Interfaces\Factory;
use GibbonCms\Gibbon\Interfaces\Repository as RepositoryInterface;
use ReflectionObject;

class EntityRepository implements RepositoryInterface
{
    /**
     * The filesystem is used to read and write files
     * 
     * @var \GibbonCms\Gibbon\Interfaces\Filesystem
     */
    private $filesystem;

    /**
     * We're using a cache because file io is slow
     * 
     * @var \GibbonCms\Gibbon\Interfaces\Cache
     */
    private $cache;

    /**
     * The entity factory transforms raw data to a usable entity
     * 
     * @var \GibbonCms\Gibbon\Interfaces\Factory
     */
    private $factory;

    /**
     * Constructor method injects all dependencies
     * 
     * @param \GibbonCms\Gibbon\Interfaces\Filesystem $filesystem
     * @param \GibbonCms\Gibbon\Interfaces\Cache $cache
     * @param \GibbonCms\Gibbon\Interfaces\Factory $factory
     */
    public function __construct(Filesystem $filesystem, Cache $cache, Factory $factory)
    {
        $this->filesystem = $filesystem;
        $this->factory = $factory;
        $this->cache = $cache;
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
     * Return a list of all ids
     * 
     * @return array
     */
    public function getList()
    {
        return array_keys($this->cache->all());
    }

    /**
     * Save an entity
     * 
     * @param mixed
     * @return bool
     */
    public function save($entity)
    {
        $fresh = is_null($entity->id);

        if ($fresh) {
            $reflection = new ReflectionObject($entity);
            $property = $reflection->getProperty('id');
            $property->setAccessible(true);
            $property->setValue($entity, $this->generateId());
        }

        $success = $this->filesystem->put(
            "{$entity->id}-{$entity->slug}.md", 
            $this->factory->encode($entity)
        );

        if ($success) {
            $this->cache->put($entity->id, $entity);
            $this->cache->persist();
        }

        return $success;
    }

    /**
     * Delete an entity
     * 
     * @return bool
     */
    public function delete($entity)
    {
        $success = $this->filesystem->delete("{$entity->id}-{$entity->slug}.md");

        if ($success) {
            $this->cache->forget($entity->id);
            $this->cache->persist();
        }

        return $success;
    }

    /**
     * Build the cache
     * 
     * @return void
     */
    public function buildCache()
    {
        $files = $this->filesystem->listFiles();

        foreach ($files as $file) {
            $entity = $this->parseFile($file);
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
            $parsedFilename = $this->parseFilename($file['filename']);

            $entity = $this->factory->make([
                'id'   => $parsedFilename['id'],
                'slug' => $parsedFilename['slug'],
                'data' => $this->filesystem->read($file['path']),
            ]);
            
            $this->cache->put($entity->id, $entity);

            return $entity;
        }
    }

    /**
     * Extract the id and slug from a filename
     * 
     * @param string $filename
     * @return array
     */
    protected function parseFilename($filename)
    {
        $parts = explode('-', $filename, 2);

        return [
            'id'   => $parts[0],
            'slug' => $parts[1],
        ];
    }

    /**
     * Generate an id for a new entity
     * 
     * @return int
     */
    protected function generateId()
    {
        $list = $this->getList();

        $last = array_pop($list);

        return intval($last) + 1;
    }
}
