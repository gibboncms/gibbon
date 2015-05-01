<?php

namespace GibbonCms\Gibbon\Tests;

use GibbonCms\Gibbon\Cache;
use GibbonCms\Gibbon\Filesystem;
use GibbonCms\Gibbon\EntityRepository;
use GibbonCms\Gibbon\Tests\Stubs\Entity;
use GibbonCms\Gibbon\Tests\Stubs\EntityFactory;

class EntityRepositoryTest extends TestCase
{
    function setUp()
    {
        $this->repository = new EntityRepository(
            new Filesystem($this->fixtures . '/entities/'),
            new Cache($this->fixtures . '/entities/.cache'),
            new EntityFactory
        );

        $this->repository->buildCache();
    }

    /** @test */
    function it_is_initializable()
    {
        $this->assertInstanceOf(EntityRepository::class, $this->repository);
    }

    /** @test */
    function it_returns_an_entity()
    {
        $this->assertInstanceOf(EntityFactory::makes(), $this->repository->find(1));
        $this->assertEquals(1, $this->repository->find(1)->id);
    }

    /** 
     * @test
     */
    function it_returns_all_entities()
    {
        $this->assertCount(2, $this->repository->getAll());
        $this->assertContainsOnlyInstancesOf(EntityFactory::makes(), $this->repository->getAll());
    }

    /** @test */
    function it_saves_an_entity()
    {
        $entity = new Entity('stub', 'lorem ipsum dolor sit');
        $this->assertTrue($this->repository->save($entity));

        $this->assertEquals($entity->id, $this->repository->find($entity->id)->id);
     
        @unlink($this->fixtures . '/entities/' . $entity->id . '-stub.md');
    }

    /** @test */
    function it_updates_an_existing_entity()
    {
        $entity = new Entity('stub', 'lorem ipsum dolor sit');
        $this->repository->save($entity);

        $entity->data = 'foo bar baz';
        $this->assertTrue($this->repository->save($entity));

        $this->assertEquals('foo bar baz', $this->repository->find($entity->id)->data);

        @unlink($this->fixtures . '/entities/' . $entity->id . '-stub.md');
    }

    /** @test */
    function it_deletes_an_entity()
    {
        $entity = new Entity('stub', 'lorem ipsum dolor sit');
        $this->repository->save($entity);
        $this->assertTrue($this->repository->delete($entity));
    }
}
