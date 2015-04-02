<?php

namespace GibbonCms\Gibbon\Core;

use GibbonCms\Gibbon\Core\Entity;
use GibbonCms\Gibbon\System\Factory;
use Symfony\Component\Yaml\Parser as Yaml;

class FileEntityFactory implements Factory
{
    public function __construct()
    {
        $this->yaml = new Yaml;
    }

    public function make($name, $data)
    {
        $components = $this->getComponents($data);

        list($created, $id) = explode('_', $name, 2);

        $meta = $this->yaml->parse($components[0]);

        return new Entity($id, $created);
    }

    public function encode(Entity $entity)
    {

    }

    protected function getComponents($data)
    {
        return explode("\n\n===\n\n", str_replace("\n\r", "\n", $data));
    }
}
