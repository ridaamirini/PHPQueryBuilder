<?php
/**
 * Created by PhpStorm.
 * User: Rida Amirini
 * Date: 26.08.2017
 * Time: 05:22
 */

namespace App\Query;


use App\Schema\Query;
use App\Schema\QueryCollection;
use App\Utils\QueryBuilderUtils;

class InsertQuery extends \InsertQuery implements QueryInterface
{
    /**
     * @param bool $formatted
     * @return string
     */
    public function getQuery($formatted = true)
    {
        return QueryBuilderUtils::build(parent::getQuery(false), parent::getParameters());
    }

    /**
     * @param $collection
     */
    public function collect(&$collection)
    {
        if (!($collection instanceof QueryCollection)) throw new \InvalidArgumentException('$collection must be an instance of QueryCollection');

        $collection->add(Query::create()->setQuery($this->getQueryPDO())
                                        ->setQueryWithValues($this->getQuery()));
    }

    /**
     * @return string
     */
    public function getQueryPDO()
    {
        return parent::getQuery();
    }
}