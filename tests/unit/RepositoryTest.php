<?php

namespace tests\unit;

use GibbonCms\Gibbon\Cache;
use GibbonCms\Gibbon\Filesystem;
use GibbonCms\Gibbon\Repository;
use tests\stubs\Entity\Entity;
use tests\stubs\Entity\EntityFactory;

class RepositoryTest extends TestCase
{
    function setUp()
    {
        $this->repository = new Repository(
            new Filesystem($this->fixtures . '/entities/'),
            new Cache($this->fixtures . '/entities/.cache'),
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

    /** @test */
    function it_saves_an_entity()
    {
        $entity = new Entity('20150429_stub', 'lorem ipsum dolor sit');
        $this->assertTrue($this->repository->save($entity));

        @unlink($this->fixtures . '/entities/20150429_stub.md');
    }

    /** @test */
    function it_updates_an_existing_entity()
    {
        $entity = new Entity('20150429_stub', 'lorem ipsum dolor sit');
        $this->repository->save($entity);

        $entity->setData('foo bar baz');
        $this->assertTrue($this->repository->save($entity));

        @unlink($this->fixtures . '/entities/20150429_stub.md');
    }
}
