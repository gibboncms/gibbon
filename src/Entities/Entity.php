<?php

namespace GibbonCms\Gibbon\Entities;

class Entity
{
    /**
     * @var string
     */
    public $id;

    /**
     * @return string
     */
    public function getIdentifier()
    {
        return $this->id;
    }
}
