<?php

namespace tests\stubs\Entity;

use GibbonCms\Gibbon\Contracts\Entity as EntityContract;
use GibbonCms\Gibbon\Contracts\Factory;

class EntityFactory implements Factory
{
    /**
     * Transform raw data to an entity
     * 
     * @param mixed $data
     * @return \GibbonCms\Gibbon\Contracts\Entity
     */
    public function make($data)
    {
        return new Entity($data['id'], $data['data']);
    }

    /**
     * Transform an entity to raw data
     * 
     * @param \GibbonCms\Gibbon\Contracts\Entity
     * @return string
     */
    public function encode(EntityContract $entity)
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
