<?php

namespace tests\unit\Core;

use GibbonCms\Gibbon\Core\StashCache;
use tests\unit\TestCase;

class StashCacheTest extends TestCase
{
    /** @test */
    function it_is_initializable()
    {
        $this->assertInstanceOf(StashCache::class, self::make());
    }

    /** @test */
    function it_sets_and_gets_a_value()
    {
        $cache = self::make();
        $cache->set('foo', 'bar');

        $this->assertEquals('bar', $cache->get('foo'));
    }

    /** @test */
    function it_can_flush()
    {
        $cache = self::make();
        $cache->set('foo', 'bar');
        $cache->flush();

        $this->assertNotEquals('bar', $cache->get('foo'));
    }
}
