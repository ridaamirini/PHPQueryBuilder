<?php
/**
 * Created by PhpStorm.
 * User: Rida Amirini
 * Date: 26.08.2017
 * Time: 05:11
 */

namespace App\Query;


use App\Utils\QueryBuilderUtils;

class SelectQuery extends \SelectQuery implements QueryInterface
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
     * @return string
     */
    public function getQueryPDO()
    {
        return parent::getQuery();
    }
}