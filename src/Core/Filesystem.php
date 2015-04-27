<?php

namespace GibbonCms\Gibbon\Core;

use GibbonCms\Gibbon\Core\Contracts\Filesystem as FilesystemContract;
use League\Flysystem\Adapter\Local as FlysystemAdapter;
use League\Flysystem\Filesystem as Flysystem;
use League\Flysystem\Plugin\ListFiles;

class Filesystem implements FilesystemContract
{
    public function __construct($path)
    {
        $this->flysystem = new Flysystem(new FlysystemAdapter($path));
        $this->flysystem->addPlugin(new ListFiles);
    }

    public function listFiles()
    {
        return $this->flysystem->listFiles();
    }

    public function read($path)
    {
        return $this->flysystem->read($path);
    }
}
