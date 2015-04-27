<?php

namespace tests\unit\Core;

use GibbonCms\Gibbon\Core\Filesystem;
use tests\unit\TestCase;

class FilesystemTest extends TestCase
{
    function setUp()
    {
        $this->filesystem = new Filesystem(__DIR__ . '/../../fixtures/entities/');
    }

    /** @test */
    function it_is_initializable()
    {
        $this->assertInstanceOf(Filesystem::class, $this->filesystem);
    }

    /** @test */
    function it_lists_files()
    {
        $this->assertCount(2, $this->filesystem->listFiles());
    }

    /** @test */
    function it_reads_a_file()
    {
        $this->assertNotEmpty($this->filesystem->read('20150424_lorem-ipsum.md'));
    }
}
