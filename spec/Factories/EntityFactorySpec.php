<?php

namespace spec\GibbonCms\Gibbon\Factories;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class EntityFactorySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('GibbonCms\Gibbon\Factories\EntityFactory');
    }
}
