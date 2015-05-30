<?php

namespace GibbonCms\Gibbon\Repositories;

interface PersistableRepository extends Repository
{
    /**
     * Delete an entity
     * 
     * @param  \GibbonCms\Gibbon\Entities\Entity
     * @return bool
     */
    public function delete($entity);

    /**
     * Copy an entity
     * 
     * @param  \GibbonCms\Gibbon\Entities\Entity $entity
     * @return \GibbonCms\Gibbon\Entities\Entity
     */
    public function copy($entity);

    /**
     * Save an entity
     * 
     * @param  \GibbonCms\Gibbon\Entities\Entity $entity
     * @return bool
     */
    public function save($entity);
}
