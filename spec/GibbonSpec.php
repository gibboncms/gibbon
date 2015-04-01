<?php

namespace spec\GibbonCms\Gibbon;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GibbonSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('GibbonCms\Gibbon\Gibbon');
    }
}
