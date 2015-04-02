<?php

namespace GibbonCms\Gibbon\System;

interface Repository
{
    public function __construct(Factory $factory, $config);

    public function all();

    public function find($id);

    public function where($query);

    public function insert();

    public function update();
}
