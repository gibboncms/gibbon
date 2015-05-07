<?php

namespace GibbonCms\Gibbon\Tests;

use GibbonCms\Gibbon\Filesystems\PlainFilesystem;

class FilesystemTest extends TestCase
{
    function setUp()
    {
        $this->filesystem = new PlainFilesystem($this->fixtures . '/entities/');
    }

    function tearDown()
    {
        $this->filesystem = new PlainFilesystem($this->fixtures . '/entities/');
    }

    /** @test */
    function it_is_initializable()
    {
        $this->assertInstanceOf(PlainFilesystem::class, $this->filesystem);
    }

    /** @test */
    function it_lists_files()
    {
        $this->assertGreaterThan(1, $this->filesystem->listFiles());
    }

    /** @test */
    function it_reads_a_file()
    {
        $this->assertNotEmpty($this->filesystem->read('1.md'));
    }

    /** @test */
    function it_writes_a_file()
    {
        $this->assertTrue($this->filesystem->put('filesystemtest.md', 'filesystemtest'));

        @unlink($this->fixtures . '/entities/filesystemtest.md');
    }

    /**
     * @test
     * @expectedException \League\Flysystem\FileNotFoundException
     */
    function it_deletes_a_file()
    {
        $this->filesystem->put('filesystemtest.md', 'filesystemtest');
        $this->filesystem->delete('filesystemtest.md');
        $this->filesystem->read('filesystemtest.md');
    }
}
