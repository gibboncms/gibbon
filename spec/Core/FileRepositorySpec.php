<?php

namespace spec\GibbonCms\Gibbon\Core;

use GibbonCms\Gibbon\Core\JsonEntityFactory;
use GibbonCms\Gibbon\Core\FileEntityFactory;
use GibbonCms\Gibbon\Core\FileRepositoryOptions;
use GibbonCms\Gibbon\Core\JsonRepository;
use GibbonCms\Gibbon\Core\JsonRepositoryOptions;
use League\Flysystem\Adapter\Local as FilesystemAdapter;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FileRepositorySpec extends ObjectBehavior
{
    function let()
    {
        $cache = new JsonRepository(
            new JsonEntityFactory, 
            new JsonRepositoryOptions(__DIR__ . '/../_fixtures/cache/entities.json')
        );

        $adapter = new FilesystemAdapter(__DIR__ . '/../_fixtures/entities/');
        $options = new FileRepositoryOptions($adapter, $cache);

        $this->beConstructedWith(new FileEntityFactory, $options);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('GibbonCms\Gibbon\Core\FileRepository');
        $this->shouldImplement('GibbonCms\Gibbon\System\Repository');
    }

    function it_returns_a_list_of_entities()
    {
        $this->all()->shouldReturn(['lorem-ipsum']);
    }

    function it_finds_an_entity()
    {
        $this->find('lorem-ipsum')->shouldHaveType('GibbonCms\Gibbon\Core\Entity');
        $this->find('lorem-ipsum')->id()->shouldReturn('lorem-ipsum');
    }
}
