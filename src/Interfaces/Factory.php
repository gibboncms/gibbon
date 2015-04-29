<?php

namespace GibbonCms\Gibbon\Interfaces;

interface Factory
{
    /**
     * Transform raw data to an entity
     * 
     * @param array $data
     * @return mixed
     */
    public function make($data);

    /**
     * Transform an entity to raw data
     * 
     * @param mixed
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
