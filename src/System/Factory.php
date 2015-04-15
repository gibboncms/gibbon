<?php

namespace GibbonCms\Gibbon\System;

interface Factory
{
    public function make($id, $data);
    public static function makes();
}
