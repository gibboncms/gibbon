<?php

namespace spec\GibbonCms\Gibbon\System;

use GibbonCms\Gibbon\System\EntityFactory;
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
        $this->shouldHaveType('GibbonCms\Gibbon\System\FileRepository');
        $this->shouldImplement('GibbonCms\Gibbon\System\Repository');
    }

    function it_returns_a_list_of_entities()
    {
        $this->all()->shouldReturn(['lorem-ipsum']);
    }

    function it_finds_an_entity()
    {
        $this->find('lorem-ipsum')->shouldHaveType('GibbonCms\Gibbon\Entity');
    }
}
