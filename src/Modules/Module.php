<?php

namespace GibbonCms\Gibbon\Modules;

interface Module
{
    /**
     * Go through the necessary steps to set up the module (build caches, etc.)
     * 
     * @return void
     */
    public function setUp();
}
