<?php

namespace GibbonCms\Gibbon\Core\Contracts;

interface Filesystem
{
    public function listFiles();
    public function read($path);
}
