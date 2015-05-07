<?php

namespace GibbonCms\Gibbon\Tests;

use GibbonCms\Gibbon\Filesystems\FileCache;
use GibbonCms\Gibbon\Filesystems\PlainFilesystem;
use GibbonCms\Gibbon\Repositories\FileRepository;
use GibbonCms\Gibbon\Tests\Stubs\Entity;
use GibbonCms\Gibbon\Tests\Stubs\EntityFactory;

class FileRepositoryTest extends TestCase
{
    function setUp()
    {
        $this->repository = new FileRepository(
            new PlainFilesystem($this->fixtures . '/entities/'),
            new FileCache($this->fixtures . '/entities/.cache'),
            new EntityFactory
        );

        $this->repository->build();
    }

    /** @test */
    function it_is_initializable()
    {
        $this->assertInstanceOf(FileRepository::class, $this->repository);
    }

    /** @test */
    function it_returns_an_entity()
    {
        $this->assertInstanceOf(EntityFactory::makes(), $this->repository->find(1));
        $this->assertEquals(1, $this->repository->find(1)->getIdentifier());
    }

    /** 
     * @test
     */
    function it_returns_all_entities()
    {
        $this->assertCount(2, $this->repository->getAll());
        $this->assertContainsOnlyInstancesOf(EntityFactory::makes(), $this->repository->getAll());
    }
}
