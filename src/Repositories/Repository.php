<?php

namespace GibbonCms\Gibbon\Repositories;

interface Repository
{
    /**
     * Find an entity by id
     * 
     * @param \GibbonCms\Gibbon\Entities\Entity $id
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
