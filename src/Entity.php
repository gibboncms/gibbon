<?php

namespace GibbonCms\Gibbon;

class Entity
{
    protected $id;
    protected $created;
    
    public function __construct($id, $created)
    {
        $this->id = $id;
        $this->created = $created;
    }
}
