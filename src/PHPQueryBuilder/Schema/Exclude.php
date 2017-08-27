<?php
/**
 * Created by Rida Amirini.
 * Initial version by: ridaamirini
 * Initial version created on: 27.08.17 - 13:45
 */

namespace App\Schema;

class Exclude
{
    private $path = '';

    public function __construct($fromArray = null)
    {
        if (!empty($fromArray)) {
            foreach ($fromArray as $key => $value) {
                if (isset($this->{$key})) $this->{$key} = $value;
            }
        }
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param string $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }

    public function toArray()
    {
        return get_object_vars($this);
    }

    public function __toString()
    {
       return json_encode(get_object_vars($this));
    }
}