<?php

namespace tests\factories\Core;

use GibbonCms\Gibbon\Core\FlysystemFilesystem;

class FlysystemFilesystemFactory
{
    static function make()
    {
        return new FlysystemFilesystem(__DIR__ . '/../../fixtures/entities/');
    }
}
