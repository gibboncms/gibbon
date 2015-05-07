<?php

namespace GibbonCms\Gibbon\Factories;

interface Factory
{
    /**
     * Transform raw data to an entity
     * 
     * @param array $data
     * @return \GibbonCms\Gibbon\Entity
     */
    public function make($data);

    /**
     * Transform an entity to raw data
     * 
     * @param \GibbonCms\Gibbon\Entities\Entity
     * @return string
     */
    public function encode($entity);

    /**
     * Return the classname of the entity this factory makes
     * 
     * @return string
     */
    public static function makes();
}
