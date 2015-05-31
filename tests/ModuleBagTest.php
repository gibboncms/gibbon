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
        $this->moduleBag->register('module', $module);

        $this->assertCount(1, $this->moduleBag->all());

        $anotherModule = $this->getMock(Module::class);
        $this->moduleBag->register('another-module', $anotherModule);

        $this->assertCount(2, $this->moduleBag->all());
    }

    /** @test */
    public function it_retrieves_modules()
    {
        $module = $this->getMock(Module::class);
        $this->moduleBag->register('module', $module);

        $this->assertEquals($module, $this->moduleBag->get('module'));
    }

    /** @test */
    public function it_throws_an_exception_when_retrieving_inexistent_module()
    {
        $this->setExpectedException('GibbonCms\Gibbon\Exceptions\ModuleDoesntExistException');

        $this->moduleBag->get('module');
    }

    /** @test */
    public function it_returns_itself_if_no_key_is_provided()
    {
        $this->assertInstanceOf(ModuleBag::class, $this->moduleBag->get());
    }

    /** @test */
    public function it_sets_up_all_modules()
    {
        $module = $this->getMock(Module::class);
        $module->expects($this->once())->method('setUp');
        $anotherModule = $this->getMock(Module::class);
        $anotherModule->expects($this->once())->method('setUp');

        $this->moduleBag->register('module', $module);
        $this->moduleBag->register('another-module', $anotherModule);
        
        $this->moduleBag->setUp();
    }
}
