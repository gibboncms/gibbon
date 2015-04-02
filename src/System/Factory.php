<?php

namespace GibbonCms\Gibbon\System;

use GibbonCms\Gibbon\Core\Entity;

/**
 * A factory transforms raw data to entities and vice-versa. It also handles caching. 
 */
interface Factory
{
    public function make($id, $data);

    public function encode(Entity $entity);
}
