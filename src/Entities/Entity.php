<?php

namespace GibbonCms\Gibbon\Entities;

use DateTime;

class Entity
{
    protected $id;
    protected $title;
    protected $created;
    
    public function __construct($id, $title, DateTime $created)
    {
        $this->id = $id;
        $this->title = $title;
        $this->created = $created;
    }

    public function id()
    {
        return $this->id;
    }

    public function created()
    {
        return $this->created;
    }

    public function title()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }
}
