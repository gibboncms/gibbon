<?php

namespace tests\stubs\Entity;

use GibbonCms\Gibbon\Entity as BaseEntity;

class Entity extends BaseEntity
{
    /**
     * @var string
     */
    protected $data;
    
    /**
     * @param string $id
     * @param string $data
     */
    public function __construct($slug, $data)
    {
        parent::__construct($slug);

        $this->data = $data;
    }

    /**
     * @return string
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param string $data
     * @return void
     */
    public function setData($data)
    {
        $this->data = $data;
    }
}
