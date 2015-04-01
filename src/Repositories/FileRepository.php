<?php

namespace GibbonCms\Gibbon\Repositories;

use GibbonCms\Gibbon\Factories\Factory;
use League\Flysystem\Filesystem;
use League\Flysystem\Adapter\Local as FilesystemAdapter;

class FileRepository implements Repository
{
    private $factory;
    private $directory;

    public function __construct(Factory $factory, $config)
    {
        $this->factory = $factory;
        $this->directory = $config['directory'];

        $this->filesystem = new Filesystem(new FilesystemAdapter($this->directory));
    }

    public function all()
    {

    }

    public function find($id)
    {
        $file = $this->filesystem->read($id . '.md');

        return $this->factory->make($file);
    }

    public function where($query)
    {

    }

    public function insert()
    {

    }

    public function update()
    {

    }
}
