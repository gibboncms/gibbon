<?php

namespace GibbonCms\Gibbon\Core;

class Page
{
    protected $id;
    protected $created;
    
    public function __construct($id, $created)
    {
        $this->id = $id;
        $this->created = $created;
    }

    public function id()
    {
        return $this->id;
    }
}
