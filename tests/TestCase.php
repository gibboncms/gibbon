<?php

namespace GibbonCms\Gibbon\Tests;

use PHPUnit_Framework_TestCase;

class TestCase extends PHPUnit_Framework_TestCase
{
    /**
     * @var string
     */
    protected $fixtures;

    public function __construct()
    {
        $this->fixtures = __DIR__ . '/fixtures';
    }
}
