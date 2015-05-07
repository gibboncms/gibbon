<?php

namespace GibbonCms\Gibbon;

use GibbonCms\Gibbon\Interfaces\PersistableRepository;
use ReflectionObject;

class PersistableEntityRepository extends EntityRepository
{
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
}
