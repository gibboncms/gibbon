<?php

namespace GibbonCms\Gibbon\Test;

use GibbonCms\Gibbon\Modules\Module;
use GibbonCms\Gibbon\Modules\ModuleBag;

class ModuleBagTest extends TestCase
{
    public function setUp()
    {
        $this->moduleBag = new ModuleBag;
    }

    /** @test */
    public function it_is_initializable()
    {
        $this->assertInstanceOf(ModuleBag::class, $this->moduleBag);
    }

    /** @test */
    public function it_registers_modules()
    {
        $module = $this->getMock(Module::class);
        $this->moduleBag->register($module);

        $this->assertCount(1, $this->moduleBag->all());

        $anotherModule = $this->getMock(Module::class);
        $this->moduleBag->register($anotherModule);

        $this->assertCount(2, $this->moduleBag->all());
    }

    /** @test */
    public function it_sets_up_all_modules()
    {
        $module = $this->getMock(Module::class);
        $anotherModule = $this->getMock(Module::class);

        $module->expects($this->once())->method('setUp');
        $anotherModule->expects($this->once())->method('setUp');

        $this->moduleBag->register($module);
        $this->moduleBag->register($anotherModule);
        
        $this->moduleBag->setUp();
    }
}
