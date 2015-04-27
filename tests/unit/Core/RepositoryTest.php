<?php

namespace tests\unit\Core;

use GibbonCms\Gibbon\Core\Cache;
use GibbonCms\Gibbon\Core\Filesystem;
use GibbonCms\Gibbon\Core\Repository;
use tests\stubs\Entity\EntityFactory;
use tests\unit\TestCase;

class RepositoryTest extends TestCase
{
    function setUp()
    {
        $this->repository = new Repository(
            new Filesystem(__DIR__ . '/../../fixtures/entities/'),
            new Cache(__DIR__ . '/../../fixtures/entities/.cache'),
            new EntityFactory
        );

        $this->repository->build();
    }

    /** @test */
    function it_is_initializable()
    {
        $this->assertInstanceOf(Repository::class, $this->repository);
    }

    /** @test */
    function it_returns_a_list_of_entities()
    {
        $this->assertCount(2, $this->repository->index());
        $this->assertContains('20150424_lorem-ipsum', $this->repository->index());
    }

    /** @test */
    function it_returns_an_entity()
    {
        $this->assertInstanceOf(EntityFactory::makes(), $this->repository->find('20150424_lorem-ipsum'));
        $this->assertEquals('20150424_lorem-ipsum', $this->repository->find('20150424_lorem-ipsum')->getId());
    }

    /** @test */
    function it_returns_all_entities()
    {
        $this->assertCount(2, $this->repository->getAll());
        $this->assertContainsOnlyInstancesOf(EntityFactory::makes(), $this->repository->getAll());
    }
}
