<?php

namespace GibbonCms\Gibbon\Filesystems;

interface Filesystem
{
    /**
     * List all the files from a directory
     * 
     * @param  string $directory
     * @param  bool $recursive
     * @return array
     */
    public function listFiles($directory, $recursive = false);

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
     * @param string $path
     * @param string $contents
     * @return bool
     */
    public function put($path, $contents);

    /**
     * Delete a file
     * 
     * @param string $path
     * @return bool
     */
    public function delete($path);
}
