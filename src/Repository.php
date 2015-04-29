<?php

namespace GibbonCms\Gibbon;

use GibbonCms\Gibbon\Contracts\Entity;
use GibbonCms\Gibbon\Contracts\Factory;
use GibbonCms\Gibbon\Contracts\Repository as RepositoryContract;

class Repository implements RepositoryContract
{
    /**
     * The filesystem is used to read and write files
     * 
     * @var \GibbonCms\Gibbon\Contracts\Filesystem
     */
    private $filesystem;

    /**
     * We're using a cache because file io is slow
     * 
     * @var \GibbonCms\Gibbon\Contracts\Cache
     */
    private $cache;

    /**
     * The entity factory transforms raw data to a usable entity
     * 
     * @var \GibbonCms\Gibbon\Contracts\Factory
     */
    private $factory;

    /**
     * Constructor method injects all dependencies
     * 
     * @param \GibbonCms\Gibbon\Contracts\Filesystem $filesystem
     * @param \GibbonCms\Gibbon\Contracts\Cache $cache
     * @param \GibbonCms\Gibbon\Contracts\Factory $factory
     */
    public function __construct(Filesystem $filesystem, Cache $cache, Factory $factory)
    {
        $this->filesystem = $filesystem;
        $this->factory = $factory;
        $this->cache = $cache;
    }

    /**
     * Return a list of all entity id's
     * 
     * @return array
     */
    public function index()
    {
        return $this->cache->get('_list');
    }

    /**
     * Find an entity by id
     * 
     * @param mixed $id
     * @return \GibbonCms\Gibbon\Contracts\Entity
     */
    public function find($id)
    {
        return $this->cache->get($id);
    }

    /**
     * Return all entities
     * 
     * @return \GibbonCms\Gibbon\Contracts\Entity[]
     */
    public function getAll()
    {
        return array_reduce($this->index(), function($carry, $id) {
            $carry[] = $this->find($id);
            return $carry;
        }, []);
    }

    /**
     * SAve an entity
     * 
     * @param \GibbonCms\Gibbon\Contracts\Entity
     * @return bool
     */
    public function save(Entity $entity)
    {
        return $this->filesystem->put(
            $entity->getId() . '.md', 
            $this->factory->encode($entity)
        );
    }

    /**
     * Build the cache
     * 
     * @return void
     */
    public function build()
    {
        $files = $this->filesystem->listFiles();

        $this->cache->place('_list', array_reduce($files, function($list, $file) {
            if ($file['extension'] == 'md') $list[] = $file['filename'];
            return $list;
        }, []));

        foreach ($files as $file) {
            if ($file['extension'] == 'md') {
                $entity = $this->factory->make([
                    'id' => $file['filename'],
                    'data' => $this->filesystem->read($file['path'])
                ]);
                
                $this->cache->place($entity->getId(), $entity);
            }
        }
    }
}
