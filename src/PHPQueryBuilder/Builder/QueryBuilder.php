<?php
/**
 * Created by PhpStorm.
 * User: Rida Amirini
 * Date: 26.08.2017
 * Time: 02:28
 */

namespace App\Builder;

use App\Builder\Base\QueryBuilderWrapper;

/**
 * Class QueryBuilder
 * @package App\Builder
 */
class QueryBuilder extends QueryBuilderWrapper
{
    public static function create()
    {
       return new self();
    }
}
