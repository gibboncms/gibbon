<?php

namespace GibbonCms\Gibbon\System;

/**
 * A repository returns entities from the persistence layer
 */
interface Repository
{
    public function __construct(Factory $factory, RepositoryOptions $options);

    public function all();

    public function find($id);

    public function insert($entity);

    public function update($entity);

    public function delete($entity);

    public function save();

    public function clean();
}
