<?php
/**
 * Created by PhpStorm.
 * User: Rida Amirini
 * Date: 26.08.2017
 * Time: 03:43
 */

namespace App\Schema;


class Query
{
    private $query_with_values;
    private $query;

    public static function create()
    {
        return new self();
    }

    /**
     * @return mixed
     */
    public function getQueryWithValues()
    {
        return $this->query_with_values;
    }

    /**
     * @param mixed $query_with_values
     *  @return $this
     */
    public function setQueryWithValues($query_with_values)
    {
        $this->query_with_values = $query_with_values;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getQuery()
    {
        return $this->query;
    }

    /**
     * @param $query
     * @return $this
     */
    public function setQuery($query)
    {
        $this->query = $query;

        return $this;
    }

    public function __toString()
    {
        return $this->getQueryWithValues() . ';' . PHP_EOL;
    }
}