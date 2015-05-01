<?php

namespace GibbonCms\Gibbon\Interfaces;

interface Repository
{
    /**
     * Find an entity by id
     * 
     * @param mixed $id
     * @return mixed
     */
    public function find($id);

    /**
     * Return all entities
     * 
     * @return mixed[]
     */
    public function getAll();

    /**
     * Save an entity
     * 
     * @param mixed
     * @return bool
     */
    public function save($entity);

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
}
