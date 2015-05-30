<?php

namespace GibbonCms\Gibbon\Support;

trait FactoryHelpers
{
    use Yaml, DataSeparation;

    /**
     * Create a new entity instance and return it filled with attributes
     * 
     * @param array $attributes
     * @return \GibbonCms\Gibbon\Entity
     */
    protected function createAndFill(array $attributes)
    {
        $entityClass = static::makes();
        $entity = new $entityClass;

        foreach($attributes as $attribute => $value) {
            $entity->$attribute = $value;
        }

        return $entity;
    }
}
