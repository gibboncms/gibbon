<?php

namespace GibbonCms\Gibbon\Test;

use GibbonCms\Gibbon\Filesystems\FileCache;

class FileCacheTest extends TestCase
{
    public function setUp()
    {
        $this->cache = new FileCache($this->fixtures . '/entities/.cache');
    }
    
    /** @test */
    public function it_is_initializable()
    {
        $this->assertInstanceOf(FileCache::class, $this->cache);
    }

    /** @test */
    public function it_puts_and_gets_a_value()
    {
        $this->cache->put('foo', 'bar');
        $this->assertEquals('bar', $this->cache->get('foo'));
    }

    /** @test */
    function if_forgets_a_value()
    {
        $this->cache->put('foo', 'bar');
        $this->assertEquals('bar', $this->cache->get('foo'));

        $this->cache->forget('foo');
        $this->assertNull($this->cache->get('foo'));
    }

    /** @test */
    public function it_can_clear()
    {
        $this->cache->put('foo', 'bar');
        $this->cache->put('baz', 'sheep');
        $this->assertEquals('bar', $this->cache->get('foo'));

        $this->cache->clear();
        $this->assertNull($this->cache->get('foo'));
        $this->assertNull($this->cache->get('baz'));
    }
}
