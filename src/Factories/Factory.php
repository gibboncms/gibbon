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
     * Return the classname of the entity this factory makes
     * 
     * @return string
     */
    public static function makes();
}
