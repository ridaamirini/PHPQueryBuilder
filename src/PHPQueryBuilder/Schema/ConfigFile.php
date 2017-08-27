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
    private $excludes = [];
    private $defaultDestination = '';

    public function __construct($fromArray = null)
    {
        if (!empty($fromArray)) {
            foreach ($fromArray as $key => $value) {
                if (isset($this->{$key})) $this->{$key} = $value;
            }

            //Map and Clean
            for ($i = 0; $i < count($this->folder); $i++) $this->folder[$i] = new Folder($this->folder[$i]);
            for ($i = 0; $i < count($this->files); $i++) $this->files[$i] = new Files($this->files[$i]);
            for ($i = 0; $i < count($this->excludes); $i++) $this->excludes[$i] = new Exclude($this->excludes[$i]);
        }
    }

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
    public function getExcludes()
    {
        return $this->excludes;
    }

    /**
     * @param array $excludes
     */
    public function setExcludes($excludes)
    {
        $this->excludes = $excludes;
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
        return @file_put_contents($path . '/phpqb.json', $this);
    }

    public function __toString()
    {
        return json_encode(get_object_vars($this));
    }
}