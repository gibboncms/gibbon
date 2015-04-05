<?php

namespace GibbonCms\Gibbon\Core;

use GibbonCms\Gibbon\System\Repository;
use GibbonCms\Gibbon\System\Factory;
use League\Flysystem\Filesystem;
use League\Flysystem\Plugin\ListFiles;

class FileRepository implements Repository
{
    protected $factory;
    protected $filesystem;
    protected $cache = [];

    public function __construct(Filesystem $filesystem, Factory $factory)
    {
        $this->factory = $factory;

        $this->filesystem = $filesystem;
        $this->filesystem->addPlugin(new ListFiles);

        if ($this->filesystem->has('.cache')) {
            $this->loadCache();
        } else {
            $this->buildCache();
        }
    }

    public function all()
    {
        return $this->cache;
    }

    public function get($id)
    {
        return $this->cache[$id];
    }

    public function insert($entity)
    {

    }

    public function update($entity)
    {

    }

    public function delete($entity)
    {

    }

    protected function buildCache()
    {
        $files = $this->filesystem->listFiles();

        $this->cache = [];

        foreach ($files as $file) {
            if ($file['extension'] == 'md') {
                $entity = $this->factory->make(
                    $file['filename'],
                    $this->filesystem->read($file['path'])
                );
                $this->cache[$entity->id()] = $entity;
            }
        }

        return $this->filesystem->put('.cache', serialize($this->cache));
    }

    protected function loadCache()
    {
        $this->cache = unserialize($this->filesystem->read('.cache'));
    }
}
