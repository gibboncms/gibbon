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
        $this->assertEquals(1, $this->repository->find(1)->getId());
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

        $this->assertEquals($entity->getId(), $this->repository->find($entity->getId())->getId());
     
        @unlink($this->fixtures . '/entities/' . $entity->getId() . '-stub.md');
    }

    /** @test */
    function it_updates_an_existing_entity()
    {
        $entity = new Entity('stub', 'lorem ipsum dolor sit');
        $this->repository->save($entity);

        $entity->setData('foo bar baz');
        $this->assertTrue($this->repository->save($entity));

        $this->assertEquals('foo bar baz', $this->repository->find($entity->getId())->getData());

        @unlink($this->fixtures . '/entities/' . $entity->getId() . '-stub.md');
    }

    /** @test */
    function it_deletes_an_entity()
    {
        $entity = new Entity('stub', 'lorem ipsum dolor sit');
        $this->repository->save($entity);
        $this->assertTrue($this->repository->delete($entity));
    }

    /** @test */
    function it_can_copy_an_entity()
    {
        $entity = $this->repository->find(1);
        $copy = $this->repository->copy($entity);
        $this->assertEquals(null, $copy->getId());

        $this->repository->save($copy);
        $this->assertEquals(3, $copy->getId());
        
        @unlink($this->fixtures . '/entities/' . $copy->getId() . '-lorem-ipsum.md');
    }
}
