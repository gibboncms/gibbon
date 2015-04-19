<?php

namespace tests\unit\Core;

use GibbonCms\Gibbon\Core\LocalRepository;
use GibbonCms\Gibbon\Entities\EntityFactory;
use tests\unit\TestCase;

class LocalRepositoryTest extends TestCase
{

    /** @test */
    function it_is_initializable()
    {
        $this->assertInstanceOf(LocalRepository::class, $this->make());
    }

    /** @test */
    function it_returns_a_list_of_entities()
    {
        $this->assertCount(2, $this->make()->index());
    }

    /** @test */
    function it_returns_an_entity()
    {
        $repository = $this->make();
        $this->assertInstanceOf(EntityFactory::makes(), $repository->get('20150402_lorem-ipsum'));
        $this->assertEquals('20150402_lorem-ipsum', $repository->get('20150402_lorem-ipsum')->id());
    }
}
