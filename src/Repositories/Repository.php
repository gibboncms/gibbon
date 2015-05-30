<?php

namespace GibbonCms\Gibbon\Repositories;

interface Repository
{
    /**
     * Find an entity by id
     * 
     * @param  string $id
     * @return \GibbonCms\Gibbon\Entities\Entity
     */
    public function find($id);

    /**
     * Return all entities
     * 
     * @return \GibbonCms\Gibbon\Entities\Entity[]
     */
    public function getAll();
}
