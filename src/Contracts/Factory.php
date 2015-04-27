<?php

namespace GibbonCms\Gibbon\Contracts;

interface Factory
{
    /**
     * Transform raw data to an entity
     * 
     * @param mixed $data
     * @return \GibbonCms\Gibbon\Contracts\Entity
     */
    public function make($data);

    /**
     * Return the classname of the entity this factory makes
     * 
     * @return string
     */
    public static function makes();
}
