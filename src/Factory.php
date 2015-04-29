<?php

namespace GibbonCms\Gibbon;

use GibbonCms\Gibbon\Contracts\Entity;
use GibbonCms\Gibbon\Contracts\Factory as FactoryContract;
use ReflectionObject;

abstract class Factory implements FactoryContract
{
    /**
     * Transform raw data to an entity
     * 
     * @param mixed $data
     * @return \GibbonCms\Gibbon\Contracts\Entity
     */
    abstract public function make($data);

    /**
     * Transform an entity to raw data
     * 
     * @param \GibbonCms\Gibbon\Contracts\Entity
     * @return string
     */
    abstract public function encode(Entity $entity);

    /**
     * Return the classname of the entity this factory makes
     * 
     * @return string
     */
    abstract public static function makes();

    /**
     * Return an entity prototype for this factory (an empty entity that hasn't been constructed).
     * All hail doctrine.
     * 
     * @return \GibbonCms\Gibbon\Contracts\Entity
     */
    protected function getPrototype()
    {
        if (!isset($this->prototype)) {
            $this->prototype = unserialize(sprintf('O:%d:"%s":0:{}', strlen(static::makes()), static::makes()));
        }

        return clone $this->prototype;
    }

    /**
     * Create a new entity instance and return it filled with attributes
     * 
     * @param array $attributes
     * @return \GibbonCms\Gibbon\Contracts\Entity
     */
    protected function createAndFill(array $attributes)
    {
        $entity = $this->getPrototype();
        $reflection = new ReflectionObject($entity);

        foreach($attributes as $attribute => $value) {
            $property = $reflection->getProperty($attribute);
            $property->setAccessible(true);
            $property->setValue($entity, $value);
        }

        return $entity;
    }
}
