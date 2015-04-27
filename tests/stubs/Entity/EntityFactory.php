<?php

namespace tests\stubs\Entity;

use GibbonCms\Gibbon\System\Factory;

class EntityFactory implements Factory
{
    public function make($id, $data)
    {
        return new Entity($id, $data);
    }

    public static function makes()
    {
        return Entity::class;
    }
}
