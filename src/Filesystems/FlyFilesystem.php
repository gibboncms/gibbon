<?php

namespace GibbonCms\Gibbon\Filesystems;

use League\Flysystem\Adapter\Local as FlysystemAdapter;
use League\Flysystem\Filesystem as Flysystem;
use League\Flysystem\Plugin\ListFiles;

abstract class FlyFilesystem implements Filesystem
{
    /**
     * List all the files from a directory
     * 
     * @param  bool $recursive
     * @return array
     */
    public function listFiles($directory = null, $recursive = false)
    {
        return $this->flysystem->listFiles($directory, $recursive);
    }

    /**
     * Return the contents of a file
     * 
     * @param  string $path
     * @return string
     */
    public function read($path)
    {
        return $this->flysystem->read($path);
    }

    /**
     * Put (save) a file
     * 
     * @param  string $path
     * @param  string $contents
     * @return bool
     */
    public function put($path, $contents)
    {
        return $this->flysystem->put($path, $contents);
    }

    /**
     * Delete a file
     * 
     * @param  string $path
     * @return bool
     */
    public function delete($path)
    {
        return $this->flysystem->delete($path);
    }
}
