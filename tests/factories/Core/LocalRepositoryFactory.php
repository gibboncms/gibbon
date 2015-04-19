<?php

namespace tests\factories\Core;

use GibbonCms\Gibbon\Core\LocalRepository;
use GibbonCms\Gibbon\Entities\EntityFactory;

class LocalRepositoryFactory
{
    static function make()
    {
        $repository = new LocalRepository(
            FlysystemFilesystemFactory::make(),
            StashCacheFactory::make(),
            new EntityFactory
        );

        $repository->refresh();

        return $repository;
    }
}
