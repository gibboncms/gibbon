<?php

namespace GibbonCms\Gibbon\System;

interface Cache
{
    public function __construct(Factory $factory, CacheOptions $options);

    public function all();

    public function find($id);
}
