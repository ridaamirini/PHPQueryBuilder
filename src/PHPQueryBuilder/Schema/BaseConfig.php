<?php
/**
 * Created by Rida Amirini.
 * Initial version by: ridaamirini
 * Initial version created on: 27.08.17 - 13:46
 */

namespace App\Schema;


abstract class BaseConfig
{
    private $from = '';
    private $to = '';

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
    public function getFrom(): string
    {
        return $this->from;
    }

    /**
     * @param string $from
     */
    public function setFrom(string $from)
    {
        $this->from = $from;
    }

    /**
     * @return string
     */
    public function getTo(): string
    {
        return $this->to;
    }

    /**
     * @param string $to
     */
    public function setTo(string $to)
    {
        $this->to = $to;
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