<?php

namespace GibbonCms\Gibbon\Core;

interface Filesystem
{
    public function listFiles();
    public function read($path);
}
