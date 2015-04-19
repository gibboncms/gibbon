<?php

namespace tests\factories\Core;

use GibbonCms\Gibbon\Core\StashCache;

class StashCacheFactory
{
    static function make()
    {
        return new StashCache(__DIR__ . '/../../fixtures/entities/.cache');
    }
}
