<?php

namespace tests\unit\Core;

use GibbonCms\Gibbon\Core\FlysystemFilesystem;
use tests\unit\TestCase;

class FlysystemFilesystemTest extends TestCase
{
    /** @test */
    function it_is_initializable()
    {
        $this->assertInstanceOf(FlysystemFilesystem::class, $this->make());
    }

    /** @test */
    function it_lists_files()
    {
        $this->assertCount(2, $this->make()->listFiles());
    }

    /** @test */
    function it_reads_a_file()
    {
        $this->assertNotEmpty($this->make()->read('20150402_lorem-ipsum.md'));
    }
}
