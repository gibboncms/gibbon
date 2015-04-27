<?php

namespace GibbonCms\Gibbon\Contracts;

interface Filesystem
{
    /**
     * List all the files from a directory
     * 
     * @return array
     */
    public function listFiles();

    /**
     * Return the contents of a file
     * 
     * @param string $path
     * @return string
     */
    public function read($path);
}
