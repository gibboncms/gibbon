<?php

namespace GibbonCms\Gibbon\Factories;

use GibbonCms\Gibbon\Entity;

interface Factory
{
    public function make($data);

    public function encode(Entity $entity);
}
