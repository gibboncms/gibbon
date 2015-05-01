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
        $cache = $this->cache;
        $cache->put('foo', 'bar');

        $this->assertEquals('bar', $cache->get('foo'));
    }

    /** @test */
    function it_can_clear()
    {
        $cache = $this->cache;
        $cache->put('foo', 'bar');
        $cache->clear();

        $this->assertNotEquals('bar', $cache->get('foo'));
    }
}
