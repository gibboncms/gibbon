<?php

namespace GibbonCms\Gibbon\Core;

use GibbonCms\Gibbon\System\Repository;
use GibbonCms\Gibbon\System\Factory;

final class LocalRepository implements Repository
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

    public function get($id)
    {
        return $this->cache->get($id);
    }

    public function refresh()
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
                $this->cache->set($entity->id(), $entity);
            }
        }
    }
}
