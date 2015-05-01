<?php

namespace GibbonCms\Gibbon\Tests;

use GibbonCms\Gibbon\Cache;

class CacheTest extends TestCase
{
    function setUp()
    {
        $this->cache = new Cache($this->fixtures . '/entities/.cache');
    }
    
    /** @test */
    function it_is_initializable()
    {
        $this->assertInstanceOf(Cache::class, $this->cache);
    }

    /** @test */
    function it_puts_and_gets_a_value()
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
    function it_can_clear()
    {
        $this->cache->put('foo', 'bar');
        $this->cache->put('baz', 'sheep');
        $this->assertEquals('bar', $this->cache->get('foo'));

        $this->cache->clear();
        $this->assertNull($this->cache->get('foo'));
        $this->assertNull($this->cache->get('baz'));
    }
}
