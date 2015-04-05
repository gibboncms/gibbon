<?php

namespace GibbonCms\Gibbon\System;

abstract class Entity
{
    protected $id;
    
    public function __construct($id)
    {
        $this->id = $id;
    }

    public function id()
    {
        return $this->id;
    }
}
