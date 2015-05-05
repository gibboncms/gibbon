<?php

namespace GibbonCms\Gibbon\Tests;

use GibbonCms\Gibbon\Filesystem;
use GibbonCms\Gibbon\ValueRepository;

class ValueRepositoryTest extends TestCase
{
    function setUp()
    {
        $this->repository = new ValueRepository(new Filesystem($this->fixtures), 'values.json');
    }

    /** @test */
    function it_is_initializable()
    {
        $this->assertInstanceOf(ValueRepository::class, $this->repository);
    }

    /** @test */
    function it_finds_a_value()
    {
        $this->assertEquals('example.com', $this->repository->find('url'));
    }

    /** @test */
    function it_finds_a_nested_value_via_dot_notation()
    {
        $this->assertEquals('sebastian@example.com', $this->repository->find('contact.email'));
    }

    /** @test */
    function it_finds_a_value_in_an_array()
    {
        $this->assertEquals('sebastian@example.com', $this->repository->find('users')[0]['email']);
        $this->assertTrue(password_verify('secret', $this->repository->find('users')[0]['password']));
    }

    /** @test */
    function it_gets_all_values()
    {
        $this->assertEquals('example.com', $this->repository->getAll()['url']);
    }

    /** @test */
    function it_sets_a_value()
    {
        $this->assertEquals('example.com', $this->repository->find('url'));
        $this->repository->set('url', 'example.org');
        $this->assertEquals('example.org', $this->repository->find('url'));
    }

    /** @test */
    function it_sets_a_value_via_dot_notation()
    {
        $this->assertEquals('sebastian@example.com', $this->repository->find('contact.email'));
        $this->repository->set('contact.email', 'sebastian@example.org');
        $this->assertEquals('sebastian@example.org', $this->repository->find('contact.email'));

        $this->assertEquals('123456789', $this->repository->find('contact.phone.home'));
        $this->repository->set('contact.phone.home', '10111213');
        $this->assertEquals('10111213', $this->repository->find('contact.phone.home'));
    }

    /** @test */
    function it_saves()
    {
        $this->assertTrue($this->repository->save());
    }
}
