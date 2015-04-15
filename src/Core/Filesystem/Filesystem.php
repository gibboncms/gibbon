<?php

namespace GibbonCms\Gibbon\Core\Filesystem;

interface Filesystem
{
    public function listFiles();
    public function read($path);
}
