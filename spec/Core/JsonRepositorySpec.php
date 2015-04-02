<?php

namespace spec\GibbonCms\Gibbon\Core;

use GibbonCms\Gibbon\Core\JsonEntityFactory;
use GibbonCms\Gibbon\Core\JsonRepositoryOptions;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class JsonRepositorySpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(
            new JsonEntityFactory,
            new JsonRepositoryOptions(__DIR__ . '/../_fixtures/cache/entities.json')
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('GibbonCms\Gibbon\Core\JsonRepository');
        $this->shouldImplement('GibbonCms\Gibbon\System\Repository');
    }

    function it_finds_an_entity()
    {
        $this->find('lorem-ipsum')->id()->shouldReturn('lorem-ipsum');
    }
}
