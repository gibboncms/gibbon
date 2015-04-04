<?php

namespace GibbonCms\Gibbon\System;

use GibbonCms\Gibbon\Core\Entity;

interface Factory
{
    public function make($id, $data);

    public function encode(Entity $entity);
}
