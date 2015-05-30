<?php

namespace GibbonCms\Gibbon\Repositories;

class PersistableFileRepository extends FileRepository implements PersistableRepository
{
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
            $entity->id = (string) $this->generateId();
        }

        $success = $this->filesystem->put(
            $this->generateFilename($entity), 
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
        $success = $this->filesystem->delete($this->generateFilename($entity));

        if ($success) {
            $this->cache->forget($entity->id);
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
        $copy->id = null;

        return $copy;
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
     * Build a file name from an entity
     * 
     * @param \GibbonCms\Gibbon\Entities\Entity
     * @return string
     */
    public function generateFilename($entity) 
    {
        return "{$entity->getIdentifier()}.md";
    }
}
