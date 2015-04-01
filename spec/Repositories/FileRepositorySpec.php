<?php

namespace spec\GibbonCms\Gibbon\Repositories;

use GibbonCms\Gibbon\Factories\EntityFactory;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FileRepositorySpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(new EntityFactory, ['directory' => __DIR__ . '/../_fixtures/entities/']);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('GibbonCms\Gibbon\Repositories\FileRepository');
        $this->shouldImplement('GibbonCms\Gibbon\Repositories\Repository');
    }

    function it_finds_an_entity()
    {
        $this->find('lorem-ipsum')->shouldHaveType('GibbonCms\Gibbon\Entity');
    }
}
