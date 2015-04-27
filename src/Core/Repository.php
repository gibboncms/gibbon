<?php

namespace GibbonCms\Gibbon\Core;

use GibbonCms\Gibbon\System\Repository as RepositoryContract;
use GibbonCms\Gibbon\System\Factory;

final class Repository implements RepositoryContract
{
    private $factory;
    private $filesystem;
    private $cache;

    public function __construct(Filesystem $filesystem, Cache $cache, Factory $factory)
    {
        $this->filesystem = $filesystem;
        $this->factory = $factory;
        $this->cache = $cache;
    }

    public function index()
    {
        return $this->cache->get('_list');
    }

    public function find($id)
    {
        return $this->cache->get($id);
    }

    public function getAll()
    {
        return array_reduce($this->index(), function($carry, $id) {
            $carry[] = $this->find($id);
            return $carry;
        }, []);
    }

    public function build()
    {
        $files = $this->filesystem->listFiles();

        $this->cache->set('_list', array_reduce($files, function($list, $file) {
            $list[] = $file['filename'];
            return $list;
        }, []));

        foreach ($files as $file) {
            if ($file['extension'] == 'md') {
                $entity = $this->factory->make(
                    $file['filename'],
                    $this->filesystem->read($file['path'])
                );
                $this->cache->set($entity->getId(), $entity);
            }
        }
    }
}
