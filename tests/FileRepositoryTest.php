<?php

namespace GibbonCms\Gibbon\Test;

use GibbonCms\Gibbon\Filesystems\FileCache;
use GibbonCms\Gibbon\Filesystems\PlainFilesystem;
use GibbonCms\Gibbon\Repositories\FileRepository;
use GibbonCms\Gibbon\Test\Stubs\Entity;
use GibbonCms\Gibbon\Test\Stubs\EntityFactory;

class FileRepositoryTest extends TestCase
{
    public function setUp()
    {
        $this->repository = new FileRepository(
            new PlainFilesystem($this->fixtures),
            'entities',
            new FileCache($this->fixtures . '/entities/.cache'),
            new EntityFactory
        );

        $this->repository->build();
    }

    /** @test */
    public function it_is_initializable()
    {
        $this->assertInstanceOf(FileRepository::class, $this->repository);
    }

    /** @test */
    public function it_returns_an_entity()
    {
        $this->assertInstanceOf(EntityFactory::makes(), $this->repository->find(1));
        $this->assertEquals(1, $this->repository->find(1)->getIdentifier());
    }

    /** 
     * @test
     */
    public function it_returns_all_entities()
    {
        $this->assertCount(2, $this->repository->getAll());
        $this->assertContainsOnlyInstancesOf(EntityFactory::makes(), $this->repository->getAll());
    }
}
