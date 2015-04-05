<?php

namespace GibbonCms\Gibbon\Core;

use DateTime;
use GibbonCms\Gibbon\System\Entity;

class Page extends Entity
{
    protected $title;
    
    public function __construct($id, $title, DateTime $created)
    {
        parent::__construct($id);

        $this->title = $title;
        $this->created = $created;
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
