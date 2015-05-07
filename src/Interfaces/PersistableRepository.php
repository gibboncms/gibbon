<?php

namespace GibbonCms\Gibbon\Interfaces;

interface PersistableRepository extends Repository
{
    /**
     * Delete an entity
     * 
     * @param mixed
     * @return bool
     */
    public function delete($entity);

    /**
     * Copy an entity
     * 
     * @param mixed $entity
     * @return mixed
     */
    public function copy($entity);

    /**
     * Save an entity
     * 
     * @param mixed
     * @return bool
     */
    public function save($entity);
}
