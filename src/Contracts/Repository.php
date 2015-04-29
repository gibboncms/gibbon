<?php

namespace GibbonCms\Gibbon\Contracts;

interface Repository
{
    /**
     * Return a list of all entity id's
     * 
     * @return array
     */
    public function index();

    /**
     * Find an entity by id
     * 
     * @param mixed $id
     * @return \GibbonCms\System\Entity
     */
    public function find($id);

    /**
     * Return all entities
     * 
     * @return \GibbonCms\System\Entity[]
     */
    public function getAll();

    /**
     * Insert
     * 
     * @param \GibbonCms\Gibbon\Contracts\Entity
     * @return bool
     */
    public function insert(Entity $entity);
}
