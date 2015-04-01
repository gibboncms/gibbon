<?php

namespace GibbonCms\Gibbon\Repositories;

use GibbonCms\Gibbon\Factories\Factory;

interface Repository
{
    public function __construct(Factory $factory, $config);

    public function all();

    public function find($id);

    public function where($query);

    public function insert();

    public function update();
}
