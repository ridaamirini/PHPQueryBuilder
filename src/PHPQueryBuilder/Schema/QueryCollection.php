<?php
/**
 * Created by Rida Amirini
 * Initial version by: ridaamirini
 * Initial version created on: 26.08.17 - 13:40
 */

namespace App\Schema;

use App\Exception\NoAccessException;

class QueryCollection
{
    /**
     * @var Query[]
     */
    private $collection = [];

    /**
     * @return Query[]
     */
    public function getCollection()
    {
        return $this->collection;
    }

    /**
     * @param Query[] $collection
     */
    public function setCollection($collection)
    {
        $this->collection = $collection;
    }

    /**
     * @param Query $query
     */
    public function add($query)
    {
        $this->collection[] = $query;
    }

    public function dump($path)
    {
        try{
            file_put_contents($path, $this->getCollection());
        }catch (\Exception $e) {
           throw new NoAccessException();
        }
    }

    public function parse()
    {
        return $this->collection;
    }
}