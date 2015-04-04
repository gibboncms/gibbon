<?php

namespace spec\GibbonCms\Gibbon\Core;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class JsonCacheOptionsSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(__DIR__ . '/../_fixtures/cache/entities.json');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('GibbonCms\Gibbon\Core\JsonCacheOptions');
        $this->shouldImplement('GibbonCms\Gibbon\System\CacheOptions');
    }
}
