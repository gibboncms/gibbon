<?php

namespace GibbonCms\Gibbon\Contracts;

interface Entity 
{
    /**
     * Get an entity's id
     * 
     * @return mixed
     */
    public function getId();

    /**
     * Set an entity's id
     * 
     * @param mixed $id
     * @return void
     */
    public function setId($id);
}
