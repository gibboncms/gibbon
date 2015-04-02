<?php

namespace GibbonCms\Gibbon\Core;

use GibbonCms\Gibbon\System\DefaultPersistence;
use GibbonCms\Gibbon\System\Repository;
use GibbonCms\Gibbon\System\RepositoryOptions;
use GibbonCms\Gibbon\System\Factory;

class JsonRepository implements Repository
{
    use DefaultPersistence;

    protected $factory;
    protected $source;
    protected $contents = [];

    public function __construct(Factory $factory, RepositoryOptions $options)
    {
        $this->factory = $factory;
        $this->source = $options->source();

        $this->parseSource();
    }

    public function all()
    {

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

    protected function insertEntity($entity)
    {

    }

    protected function updateEntity($entity)
    {

    }

    protected function deleteEntity($entity)
    {

    }
}
