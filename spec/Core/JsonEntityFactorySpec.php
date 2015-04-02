<?php

namespace spec\GibbonCms\Gibbon\Core;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class JsonEntityFactorySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('GibbonCms\Gibbon\Core\JsonEntityFactory');
    }
}
