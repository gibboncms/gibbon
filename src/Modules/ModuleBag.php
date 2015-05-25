<?php

namespace GibbonCms\Gibbon\Modules;

class ModuleBag
{
    /**
     * @var array
     */
    protected $modules = [];

    /**
     * Register a module
     * 
     * @param  \GibbonCms\Gibbon\Modules\Module $module
     * @return void
     */
    public function register(Module $module)
    {
        $this->modules[] = $module;
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
