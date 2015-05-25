<?php

namespace GibbonCms\Gibbon\Test;

use GibbonCms\Gibbon\Filesystems\FileCache;
use GibbonCms\Gibbon\Filesystems\PlainFilesystem;
use GibbonCms\Gibbon\Repositories\PersistableFileRepository;
use GibbonCms\Gibbon\Test\Stubs\Entity;
use GibbonCms\Gibbon\Test\Stubs\EntityFactory;

class PersistableFileRepositoryTest extends TestCase
{
    public function setUp()
    {
        $this->repository = new PersistableFileRepository(
            new PlainFilesystem($this->fixtures . '/entities/'),
            new FileCache($this->fixtures . '/entities/.cache'),
            new EntityFactory
        );

        $this->repository->build();
    }

    /** @test */
    public function it_is_initializable()
    {
        $this->assertInstanceOf(PersistableFileRepository::class, $this->repository);
    }

    /** @test */
    public function it_saves_an_entity()
    {
        $entity = new Entity;
        $this->assertTrue($this->repository->save($entity));

        $this->assertEquals(
            $entity->getIdentifier(),
            $this->repository->find($entity->getIdentifier())->getIdentifier()
        );
     
        @unlink($this->fixtures . '/entities/' . $entity->getIdentifier() . '.md');
    }

    /** @test */
    public function it_updates_an_existing_entity()
    {
        $entity = new Entity;
        $this->repository->save($entity);

        $entity->data = 'foo bar baz';
        $this->assertTrue($this->repository->save($entity));

        $this->assertEquals('foo bar baz', $this->repository->find($entity->getIdentifier())->data);

        @unlink($this->fixtures . '/entities/' . $entity->getIdentifier() . '.md');
    }

    /** @test */
    public function it_deletes_an_entity()
    {
        $entity = new Entity('stub', 'lorem ipsum dolor sit');
        $this->repository->save($entity);
        $this->assertTrue($this->repository->delete($entity));
    }

    /** @test */
    public function it_can_copy_an_entity()
    {
        $entity = $this->repository->find(1);
        $copy = $this->repository->copy($entity);
        $this->assertEquals(null, $copy->getIdentifier());

        $this->repository->save($copy);
        $this->assertEquals(3, $copy->getIdentifier());
        
        @unlink($this->fixtures . '/entities/' . $copy->getIdentifier() . '.md');
    }
}
