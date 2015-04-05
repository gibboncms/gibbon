<?php

namespace spec\GibbonCms\Gibbon\Core;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class EntitySpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('lorem', 'ipsum');
    }
    
    function it_is_initializable()
    {
        $this->shouldHaveType('GibbonCms\Gibbon\Core\Entity');
    }
}
