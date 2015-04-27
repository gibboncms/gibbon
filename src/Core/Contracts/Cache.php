<?php

namespace GibbonCms\Gibbon\Core\Contracts;

interface Cache
{
    public function get($key);
    public function set($key, $value);
    public function flush();
}
