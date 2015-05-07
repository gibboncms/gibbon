<?php

namespace GibbonCms\Gibbon;

use GibbonCms\Gibbon\Interfaces\Factory as FactoryInterface;
use GibbonCms\Gibbon\Interfaces\PersistableRepository;
use ReflectionObject;

class EntityRepository implements PersistableRepository
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
        $fresh = is_null($entity->getId());

        if ($fresh) {
            $this->setNewId($entity, $this->generateId());
        }

        $success = $this->filesystem->put(
            "{$entity->getId()}-{$entity->getSlug()}.md", 
            $this->factory->encode($entity)
        );

        if ($success) {
            $this->cache->put($entity->getId(), $entity);
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
        $success = $this->filesystem->delete("{$entity->getId()}-{$entity->getSlug()}.md");

        if ($success) {
            $this->cache->forget($entity->getId());
            $this->cache->persist();
        }

        return $success;
    }

    /**
     * Copy an entity
     * 
     * @param mixed $entity
     * @return mixed
     */
    public function copy($entity)
    {
        $copy = clone $entity;
        $this->setNewId($copy);

        return $copy;
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
            
            $this->cache->put($entity->getId(), $entity);

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

    /**
     * Set a new, valid id on an entity
     * 
     * @param mixed $entity
     * @param mixed $id
     * @return mixed
     */
    protected function setNewId($entity, $id = null)
    {
        $reflection = new ReflectionObject($entity);
        $property = $reflection->getProperty('id');
        $property->setAccessible(true);
        $property->setValue($entity, $id);

        return $entity;
    }
}
