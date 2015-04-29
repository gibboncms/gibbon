<?php

namespace tests\stubs\Entity;

use GibbonCms\Gibbon\Factory;
use GibbonCms\Gibbon\Interfaces\Factory as FactoryInterface;

class EntityFactory extends Factory
{
    /**
     * Transform raw data to an entity
     * 
     * @param mixed $data
     * @return \GibbonCms\Gibbon\Interfaces\Entity
     */
    public function make($data)
    {
        return $this->createAndFill($data);
    }

    /**
     * Transform an entity to raw data
     * 
     * @param \GibbonCms\Gibbon\Interfaces\Entity
     * @return string
     */
    public function encode($entity)
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
