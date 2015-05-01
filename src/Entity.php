<?php

namespace GibbonCms\Gibbon;

class Entity
{
    /**
     * @var string
     */
    public $id;

    /**
     * @var string
     */
    public $slug;
    
    /**
     * @param string $id
     * @param string $data
     */
    public function __construct($slug)
    {
        $this->slug = $slug;
    }
}
