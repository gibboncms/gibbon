<?php

namespace GibbonCms\Gibbon\Core;

use GibbonCms\Gibbon\System\Entity;
use GibbonCms\Gibbon\System\Factory;
use Symfony\Component\Yaml\Parser as Yaml;

class FileEntityFactory implements Factory
{
    public function __construct()
    {
        $this->yaml = new Yaml;
    }

    public function make($id, $data)
    {
        list($rawMeta, $body) = explode("\n\n===\n\n", str_replace("\n\r", "\n", $data), 2);

        $meta = $this->yaml->parse($rawMeta);

        return new Page($id, $meta['created']);
    }

    public function encode($entity)
    {

    }
}
