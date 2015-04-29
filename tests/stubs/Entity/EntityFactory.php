<?php

namespace tests\stubs\Entity;

use GibbonCms\Gibbon\Interfaces\Entity as EntityInterface;
use GibbonCms\Gibbon\Interfaces\Factory;

class EntityFactory implements Factory
{
    /**
     * Transform raw data to an entity
     * 
     * @param mixed $data
     * @return \GibbonCms\Gibbon\Interfaces\Entity
     */
    public function make($data)
    {
        return new Entity($data['id'], $data['data']);
    }

    /**
     * Transform an entity to raw data
     * 
     * @param \GibbonCms\Gibbon\Interfaces\Entity
     * @return string
     */
    public function encode(EntityInterface $entity)
    {
        return $entity->getData();
    }

    /**
     * Return the classname of the entity this factory makes
     * 
     * @return string
     */
    public static function makes()
    {
        return Entity::class;
    }
}
