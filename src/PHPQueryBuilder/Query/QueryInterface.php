<?php
/**
 * Created by PhpStorm.
 * User: Rida Amirini
 * Date: 26.08.2017
 * Time: 05:23
 */

namespace App\Query;


interface QueryInterface
{
    /**
     * @param bool $formatted
     * @return string
     */
    public function getQuery($formatted = false);

    /**
     * @return string
     */
    public function getQueryPDO();

    /**
     * @return mixed
     */
    public function getParameters();

    /**
     * @param $collection
     */
    public function collect(&$collection);
}