<?php

namespace tests\stubs\Entity;

use GibbonCms\Gibbon\Contracts\Entity as EntityContract;

class Entity implements EntityContract
{
    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $data;
    
    /**
     * @param string $id
     * @param string $data
     */
    public function __construct($id, $data)
    {
        $this->id = $id;
        $this->data = $data;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string
     * @return void
     */
    public function setId($id)
    {
        $this->id = $id;
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
