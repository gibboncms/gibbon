<?php

namespace spec\GibbonCms\Gibbon\Core;

use GibbonCms\Gibbon\Core\FileEntityFactory;
use League\Flysystem\Adapter\Local as FilesystemAdapter;
use League\Flysystem\Filesystem;
use PhpSpec\ObjectBehavior;

class FileRepositorySpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(
            new Filesystem(new FilesystemAdapter(__DIR__ . '/../_fixtures/entities/')),
            new FileEntityFactory
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('GibbonCms\Gibbon\Core\FileRepository');
        $this->shouldImplement('GibbonCms\Gibbon\System\Repository');
    }

    function it_returns_a_list_of_entities()
    {
        $this->all()->shouldHaveCount(2);
    }

    function it_gets_an_entity()
    {
        $this->get('20150402_lorem-ipsum')->shouldHaveType('GibbonCms\Gibbon\Core\Entity');
        $this->get('20150402_lorem-ipsum')->id()->shouldReturn('20150402_lorem-ipsum');
    }
}
