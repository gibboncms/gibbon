<?php

namespace GibbonCms\Gibbon\Core;

use GibbonCms\Gibbon\System\Repository;
use GibbonCms\Gibbon\System\RepositoryOptions;
use GibbonCms\Gibbon\System\Factory;

class JsonRepository implements Repository
{
    protected $factory;
    protected $contents;

    public function __construct(Factory $factory, RepositoryOptions $options)
    {
        $this->factory = $factory;
        $contents = json_decode(file_get_contents($options->filename()), true);

        $this->contents = [];

        array_walk($contents, function($data, $name) {
            $entity = $this->factory->make($name, $data);
            $this->contents[$entity->id()] = $entity;
        });
    }

    public function all()
    {

    }

    public function find($id)
    {
        return isset($this->contents[$id]) ? $this->contents[$id] : null;
    }
}
