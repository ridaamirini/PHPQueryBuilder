<?php
/**
 * Created by PhpStorm.
 * User: Rida Amirini
 * Date: 26.08.2017
 * Time: 05:32
 */

namespace App\Utils;


class QueryBuilderUtils
{
    /**
     * @param $query
     * @param $values
     * @return string
     */
    public static function build($query, $values)
    {
        for ($i = 0; $i < count($values); $i++) $values[$i] = self::strictDataTypes($values[$i]);

        $buffer = str_replace(array('%', '?'), array('%%', '%s'), $query);

        return vsprintf($buffer, $values);
    }

    public static function strictDataTypes($value)
    {
        return is_numeric($value) ? $value : '`'.$value.'`';
    }
}