<?php

namespace GibbonCms\Gibbon\Core;

use GibbonCms\Gibbon\System\Repository;
use GibbonCms\Gibbon\System\RepositoryOptions;
use GibbonCms\Gibbon\System\Factory;
use League\Flysystem\Filesystem;
use League\Flysystem\Plugin\ListFiles;

class FileRepository implements Repository
{
    protected $factory;
    protected $files;

    public function __construct(Factory $factory, RepositoryOptions $options)
    {
        $this->factory = $factory;

        $this->filesystem = new Filesystem($options->adapter());
        $this->filesystem->addPlugin(new ListFiles);
    }

    public function all()
    {
        return array_reduce($this->files(), function($filenames, $file) {
            $filenames[] = $this->parseId($file['filename']);
            return $filenames;
        }, []);
    }

    public function find($id)
    {
        $filename = null;
        $file = null;

        foreach ($this->files() as $iFile) {

            $iId = $this->parseId($iFile['filename']);

            if ($iId == $id) {
                $filename = $iFile['filename'];
                $file = $this->filesystem->read($iFile['basename']);
                break;
            }
        }

        return $this->factory->make($filename, $file);
    }

    protected function files()
    {
        // Todo: This will probably be handled by the cache

        if (is_null($this->files))
        {
            $this->files = $this->filesystem->listFiles();
        }

        return $this->files;
    }

    protected function parseId($filename)
    {
        // Todo: Should the repo be handling this function?

        return preg_filter('/[0-9]{8}_/', '', $filename);
    }
}
