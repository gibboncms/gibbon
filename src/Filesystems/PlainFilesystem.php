<?php

namespace GibbonCms\Gibbon\Filesystems;

use League\Flysystem\Adapter\Local as FlysystemAdapter;
use League\Flysystem\Filesystem as Flysystem;
use League\Flysystem\Plugin\ListFiles;

class PlainFilesystem extends FlyFilesystem implements Filesystem
{
    /**
     * Constructor method
     * 
     * @param string $path
     */
    public function __construct($path)
    {
        $this->flysystem = new Flysystem(new FlysystemAdapter($path));
        $this->flysystem->addPlugin(new ListFiles);
    }
}
