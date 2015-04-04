<?php

namespace GibbonCms\Gibbon\Core;

use GibbonCms\Gibbon\System\Cache;
use GibbonCms\Gibbon\System\CacheOptions;
use GibbonCms\Gibbon\System\Factory;

class JsonCache implements Cache
{
    protected $factory;
    protected $source;
    protected $contents = [];

    public function __construct(Factory $factory, CacheOptions $options)
    {
        $this->factory = $factory;
        $this->source = $options->source();

        $this->parseSource();
    }

    public function all()
    {
        return $this->contents;
    }

    public function find($id)
    {
        return isset($this->contents[$id]) ? $this->contents[$id] : null;
    }

    protected function parseSource()
    {
        $contents = json_decode(file_get_contents($this->source), true);

        array_walk($contents, function($data, $name) {
            $entity = $this->factory->make($name, $data);
            $this->contents[$entity->id()] = $entity;
        });
    }
}
