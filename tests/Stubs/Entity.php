<?php

namespace GibbonCms\Gibbon\Tests\Stubs;

use GibbonCms\Gibbon\Entity as BaseEntity;

class Entity extends BaseEntity
{
    /**
     * @var string
     */
    public $data;
    
    /**
     * @param string $id
     * @param string $data
     */
    public function __construct($slug, $data)
    {
        parent::__construct($slug);

        $this->data = $data;
    }
}
