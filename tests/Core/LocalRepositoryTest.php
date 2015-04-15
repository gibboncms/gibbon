<?php

namespace tests\Core;

use GibbonCms\Gibbon\Core\LocalRepository;
use GibbonCms\Gibbon\Entities\EntityFactory;
use PHPUnit_Framework_TestCase as TestCase;

class LocalRepositoryTest extends TestCase
{
    static function make()
    {
        $repository = new LocalRepository(
            FlysystemFilesystemTest::make(),
            StashCacheTest::make(),
            new EntityFactory
        );

        $repository->refresh();

        return $repository;
    }

    /** @test */
    function it_is_initializable()
    {
        $this->assertInstanceOf(LocalRepository::class, self::make());
    }

    /** @test */
    function it_returns_a_list_of_entities()
    {
        $this->assertCount(2, self::make()->index());
    }

    /** @test */
    function it_returns_an_entity()
    {
        $repository = self::make();
        $this->assertInstanceOf(EntityFactory::makes(), $repository->get('20150402_lorem-ipsum'));
        $this->assertEquals('20150402_lorem-ipsum', $repository->get('20150402_lorem-ipsum')->id());
    }
}
