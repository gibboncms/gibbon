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
    function it_places_and_gets_a_value()
    {
        $cache = $this->cache;
        $cache->place('foo', 'bar');

        $this->assertEquals('bar', $cache->get('foo'));
    }

    /** @test */
    function it_can_flush()
    {
        $cache = $this->cache;
        $cache->place('foo', 'bar');
        $cache->flush();

        $this->assertNotEquals('bar', $cache->get('foo'));
    }
}
