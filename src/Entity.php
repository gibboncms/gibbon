<?php

namespace GibbonCms\Gibbon;

class Entity
{
    private $name;
    private $contents;
    
    public function __construct($name, $contents)
    {
        $this->name = $name;
        $this->contents = $contents;
    }
}
