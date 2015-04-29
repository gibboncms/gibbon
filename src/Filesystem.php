<?php

namespace GibbonCms\Gibbon;

use GibbonCms\Gibbon\Interfaces\Filesystem as FilesystemInterface;
use League\Flysystem\Adapter\Local as FlysystemAdapter;
use League\Flysystem\Filesystem as Flysystem;
use League\Flysystem\Plugin\ListFiles;

class Filesystem implements FilesystemInterface
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

    /**
     * List all the files from a directory
     * 
     * @return array
     */
    public function listFiles()
    {
        return $this->flysystem->listFiles();
    }

    /**
     * Return the contents of a file
     * 
     * @param string $path
     * @return string
     */
    public function read($path)
    {
        return $this->flysystem->read($path);
    }

    /**
     * Put (save) a file
     * 
     * @param string $filename
     * @param string $contents
     * @return bool
     */
    public function put($filename, $contents)
    {
        return $this->flysystem->put($filename, $contents);
    }
}
