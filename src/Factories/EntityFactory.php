<?php

namespace GibbonCms\Gibbon\Factories;

use GibbonCms\Gibbon\Entity;
use Symfony\Component\Yaml\Parser as Yaml;

class EntityFactory implements Factory
{
    public function __construct()
    {
        $this->yaml = new Yaml;
    }

    public function make($data)
    {
        list($rawMeta, $contents) = explode("\n\n===\n\n", str_replace("\n\r", "\n", $data), 2);

        $meta = $this->yaml->parse($rawMeta);

        return new Entity($meta['name'], $contents);
    }

    public function encode(Entity $entity)
    {

    }
}
