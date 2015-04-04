<?php

namespace spec\GibbonCms\Gibbon\Core;

use GibbonCms\Gibbon\Core\JsonEntityFactory;
use GibbonCms\Gibbon\Core\JsonCache;
use GibbonCms\Gibbon\Core\JsonCacheOptions;
use League\Flysystem\Adapter\Local as FilesystemAdapter;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FileRepositoryOptionsSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(
            new FilesystemAdapter(__DIR__ . '/../_fixtures/entities/'),
            new JsonCache(
                new JsonEntityFactory,
                new JsonCacheOptions(__DIR__ . '/../_fixtures/cache/entities.json')
            )
        );
    }
    
    function it_is_initializable()
    {
        $this->shouldHaveType('GibbonCms\Gibbon\Core\FileRepositoryOptions');
        $this->shouldImplement('GibbonCms\Gibbon\System\RepositoryOptions');
    }
}
