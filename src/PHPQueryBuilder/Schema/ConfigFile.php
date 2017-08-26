<?php
/**
 * Created by PhpStorm.
 * User: Rida Amirini
 * Date: 26.08.2017
 * Time: 18:11
 */

namespace App\Schema;


class ConfigFile
{
    private $folder = [];
    private $files = [];
    private $excludedFolder = [];
    private $defaultDestination = '';

    /**
     * @return array
     */
    public function getFolder()
    {
        return $this->folder;
    }

    /**
     * @param array $folder
     */
    public function setFolder($folder)
    {
        $this->folder = $folder;
    }

    /**
     * @return array
     */
    public function getFiles()
    {
        return $this->files;
    }

    /**
     * @param array $files
     */
    public function setFiles($files)
    {
        $this->files = $files;
    }

    /**
     * @return array
     */
    public function getExcludedFolder()
    {
        return $this->excludedFolder;
    }

    /**
     * @param array $excludedFolder
     */
    public function setExcludedFolder($excludedFolder)
    {
        $this->excludedFolder = $excludedFolder;
    }

    /**
     * @return string
     */
    public function getDefaultDestination()
    {
        return $this->defaultDestination;
    }

    /**
     * @param string $defaultDestination
     */
    public function setDefaultDestination($defaultDestination)
    {
        $this->defaultDestination = $defaultDestination;
    }

    /**
     * @param $path
     * @return bool|int
     */
    public function save($path)
    {
        return file_put_contents($path, $this);
    }

    public function __toString()
    {
        return json_encode(get_object_vars($this));
    }
}