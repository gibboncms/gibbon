<?php

namespace spec\GibbonCms\Gibbon\Core;

use GibbonCms\Gibbon\Core\JsonEntityFactory;
use GibbonCms\Gibbon\Core\JsonCacheOptions;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class JsonCacheSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(
            new JsonEntityFactory,
            new JsonCacheOptions(__DIR__ . '/../_fixtures/cache/entities.json')
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('GibbonCms\Gibbon\Core\JsonCache');
        $this->shouldImplement('GibbonCms\Gibbon\System\Cache');
    }

    function it_finds_all_entities()
    {
        $this->all()->shouldHaveCount(2);
    }

    function it_finds_an_entity()
    {
        $this->find('lorem-ipsum')->id()->shouldReturn('lorem-ipsum');
    }
}
