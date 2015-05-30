<?php

namespace GibbonCms\Gibbon\Test;

use GibbonCms\Gibbon\Filesystems\PlainFilesystem;

class FilesystemTest extends TestCase
{
    public function setUp()
    {
        $this->filesystem = new PlainFilesystem($this->fixtures . '/entities/');
    }

    /** @test */
    public function it_is_initializable()
    {
        $this->assertInstanceOf(PlainFilesystem::class, $this->filesystem);
    }

    /** @test */
    public function it_lists_files()
    {
        $this->assertCount(3, $this->filesystem->listFiles());
    }
    
    /** @test */
    public function it_lists_files_recursively()
    {
        $this->assertCount(4, $this->filesystem->listFiles(null, true));
    }

    /** @test */
    public function it_reads_a_file()
    {
        $this->assertNotEmpty($this->filesystem->read('1.md'));
    }

    /** @test */
    public function it_writes_a_file()
    {
        $this->assertTrue($this->filesystem->put('filesystemtest.md', 'filesystemtest'));

        @unlink($this->fixtures . '/entities/filesystemtest.md');
    }

    /**
     * @test
     * @expectedException \League\Flysystem\FileNotFoundException
     */
    public function it_deletes_a_file()
    {
        $this->filesystem->put('filesystemtest.md', 'filesystemtest');
        $this->filesystem->delete('filesystemtest.md');
        $this->filesystem->read('filesystemtest.md');
    }
}
