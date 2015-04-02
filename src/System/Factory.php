<?php

namespace GibbonCms\Gibbon\System;

use GibbonCms\Gibbon\Entity;

interface Factory
{
    public function make($id, $data);

    public function encode(Entity $entity);
}
