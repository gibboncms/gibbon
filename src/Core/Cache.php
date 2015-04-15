<?php

namespace GibbonCms\Gibbon\Core;

interface Cache
{
    public function get($key);
    public function set($key, $value);
    public function flush();
}
