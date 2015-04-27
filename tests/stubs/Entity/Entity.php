<?php

namespace tests\stubs\Entity;

use GibbonCms\Gibbon\System\Entity as EntityContract;

class Entity implements EntityContract
{
    protected $id;
    protected $data;
    
    public function __construct($id, $data)
    {
        $this->id = $id;
        $this->data = $data;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getData()
    {
        return $this->data;
    }

    public function setData($data)
    {
        $this->data = $data;
    }
}
