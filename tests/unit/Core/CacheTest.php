<?php

namespace tests\unit\Core;

use GibbonCms\Gibbon\Core\Cache;
use tests\unit\TestCase;

class CacheTest extends TestCase
{
    function setUp()
    {
        $this->cache = new Cache(__DIR__ . '/../../fixtures/entities/.cache');
    }
    
    /** @test */
    function it_is_initializable()
    {
        $this->assertInstanceOf(Cache::class, $this->cache);
    }

    /** @test */
    function it_sets_and_gets_a_value()
    {
        $cache = $this->cache;
        $cache->set('foo', 'bar');

        $this->assertEquals('bar', $cache->get('foo'));
    }

    /** @test */
    function it_can_flush()
    {
        $cache = $this->cache;
        $cache->set('foo', 'bar');
        $cache->flush();

        $this->assertNotEquals('bar', $cache->get('foo'));
    }
}
