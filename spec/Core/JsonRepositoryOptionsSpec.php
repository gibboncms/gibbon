<?php

namespace spec\GibbonCms\Gibbon\Core;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class JsonRepositoryOptionsSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(__DIR__ . '/../_fixtures/cache/entities.json');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('GibbonCms\Gibbon\Core\JsonRepositoryOptions');
        $this->shouldImplement('GibbonCms\Gibbon\System\RepositoryOptions');
    }
}
