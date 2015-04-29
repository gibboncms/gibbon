<?php

namespace GibbonCms\Gibbon;

class Entity
{
    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $slug;
    
    /**
     * @param string $id
     * @param string $data
     */
    public function __construct($slug)
    {
        $this->slug = $slug;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     * @return void
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }
}
