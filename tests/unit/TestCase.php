<?php

namespace tests\unit;

use PHPUnit_Framework_TestCase;

class TestCase extends PHPUnit_Framework_TestCase
{
    protected function make()
    {
        $factory = preg_replace(
            '/^tests\\\unit\\\([^$]+)Test$/',
            'tests\\\factories\\\${1}Factory',
            static::class
        );

        return call_user_func("$factory::make");
    }
}
