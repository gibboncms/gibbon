<?php

namespace tests\Core;

use GibbonCms\Gibbon\Core\StashCache;
use PHPUnit_Framework_TestCase as TestCase;

class StashCacheTest extends TestCase
{
    static function make()
    {
        return new StashCache(__DIR__ . '/../fixtures/entities/.cache');
    }

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
