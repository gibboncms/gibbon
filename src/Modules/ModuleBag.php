<?php

namespace GibbonCms\Gibbon\Modules;

use GibbonCms\Gibbon\Exceptions\ModuleDoesntExistException;

class ModuleBag
{
    /**
     * @var array
     */
    protected $modules = [];

    /**
     * Register a module
     * 
     * @param  string $key
     * @param  \GibbonCms\Gibbon\Modules\Module $module
     * @return void
     */
    public function register($key, Module $module)
    {
        $this->modules[$key] = $module;
    }

    /**
     * Retrieve a registered module
     * 
     * @param  string|null $key
     * @return \GibbonCms\Gibbon\Modules\Module|self
     */
    public function get($key = null)
    {
        if ($key === null) {
            return $this;
        }
        
        if (!isset($this->modules[$key])) {
            throw new ModuleDoesntExistException($key);
        }
        
        return $this->modules[$key];
    }

    /**
     * Return all the registered modules
     * 
     * @return array
     */
    public function all()
    {
        return $this->modules;
    }

    /**
     * Call the setUp function on all registered module
     * 
     * @return void
     */
    public function setUp()
    {
        foreach ($this->modules as $module) {
            $module->setUp();
        }
    }
}
