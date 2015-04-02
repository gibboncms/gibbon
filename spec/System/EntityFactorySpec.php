<?php

namespace spec\GibbonCms\Gibbon\System;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class EntityFactorySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('GibbonCms\Gibbon\System\EntityFactory');
    }
}
