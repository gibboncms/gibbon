<?php

namespace GibbonCms\Gibbon\Core;

use GibbonCms\Gibbon\Core\Entity;
use GibbonCms\Gibbon\System\Factory;

class JsonEntityFactory implements Factory
{
    public function __construct()
    {

    }

    public function make($name, $data)
    {
        return new Entity($name, $data['created']);
    }

    public function encode(Entity $entity)
    {

    }
}
