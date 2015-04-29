<?php

namespace GibbonCms\Gibbon;

use GibbonCms\Gibbon\Interfaces\Entity;
use GibbonCms\Gibbon\Interfaces\Factory as FactoryInterface;
use ReflectionObject;

abstract class Factory implements FactoryInterface
{
    /**
     * Return an entity prototype for this factory (an empty entity that hasn't been constructed).
     * All hail doctrine.
     * 
     * @return \GibbonCms\Gibbon\Interfaces\Entity
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
     * @return \GibbonCms\Gibbon\Interfaces\Entity
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
