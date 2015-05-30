<?php

namespace GibbonCms\Gibbon\Filesystems;

use Dropbox\Client as Dropbox;
use League\Flysystem\Dropbox\DropboxAdapter as FlysystemAdapter;
use League\Flysystem\Filesystem as Flysystem;
use League\Flysystem\Plugin\ListFiles;

class DropboxFilesystem extends FlyFilesystem implements Filesystem
{
    /**
     * Constructor method
     * 
     * @param string $token
     */
    public function __construct($token)
    {
        $dropbox = new Dropbox($token, 'GibbonCms/1.0');

        $this->flysystem = new Flysystem(new FlysystemAdapter($dropbox));
        $this->flysystem->addPlugin(new ListFiles);
    }
}
