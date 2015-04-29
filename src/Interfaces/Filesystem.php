<?php

namespace GibbonCms\Gibbon\Interfaces;

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

    /**
     * Put (save) a file
     * 
     * @param string $filename
     * @param string $contents
     * @return bool
     */
    public function put($filename, $contents);
}
