<?php

namespace GibbonCms\Gibbon\Tests\Stubs;

use GibbonCms\Gibbon\Factories\Factory;
use GibbonCms\Gibbon\Support\FactoryHelpers;

class EntityFactory implements Factory
{
    use FactoryHelpers;

    /**
     * Transform raw data to an entity
     * 
     * @param array $data
     * @return mixed
     */
    public function make($data)
    {
        return $this->createAndFill($data);
    }

    /**
     * Transform an entity to raw data
     * 
     * @param mixed
     * @return string
     */
    public function encode($entity)
    {
        return $entity->data;
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
