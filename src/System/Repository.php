<?php

namespace GibbonCms\Gibbon\System;

/**
 * A repository provides a normalized interface to return entities from the persistence layer
 */
interface Repository
{
    public function __construct(Factory $factory, RepositoryOptions $options);

    public function all();

    public function find($id);
}
