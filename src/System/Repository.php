<?php

namespace GibbonCms\Gibbon\System;

interface Repository
{
    public function all();
    public function get($id);
    public function insert($entity);
    public function update($entity);
    public function delete($entity);
}
