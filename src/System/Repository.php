<?php

namespace GibbonCms\Gibbon\System;

interface Repository
{
    public function index();
    public function find($id);
    public function getAll();
}
