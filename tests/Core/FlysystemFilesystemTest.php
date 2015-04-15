<?php

namespace tests\Core;

use GibbonCms\Gibbon\Core\FlysystemFilesystem;
use PHPUnit_Framework_TestCase as TestCase;

class FlysystemFilesystemTest extends TestCase
{
    static function make()
    {
        return new FlysystemFilesystem(__DIR__ . '/../fixtures/entities/');
    }

    /** @test */
    function it_is_initializable()
    {
        $this->assertInstanceOf(FlysystemFilesystem::class, self::make());
    }

    /** @test */
    function it_lists_files()
    {
        $this->assertCount(2, self::make()->listFiles());
    }

    /** @test */
    function it_reads_a_file()
    {
        $this->assertNotEmpty(self::make()->read('20150402_lorem-ipsum.md'));
    }
}
