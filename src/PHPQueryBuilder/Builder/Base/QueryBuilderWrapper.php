<?php
/**
 * Created by PhpStorm.
 * User: Rida Amirini
 * Date: 26.08.2017
 * Time: 02:28
 */

namespace App\Builder\Base;

use App\Query\DeleteQuery;
use App\Query\InsertQuery;
use App\Query\SelectQuery;
use App\Query\UpdateQuery;

/**
 * Class QueryBuilderWrapper
 * @package App\Builder\Base
 */
abstract class QueryBuilderWrapper extends \FluentPDO
{
    /**
     * @param $table
     * @param null $primaryKey
     * @return SelectQuery|\SelectQuery
     */
    public function select($table, $primaryKey = null)
    {
        $query = new SelectQuery($this, $table);

        if ($primaryKey !== null) {
            $tableTable     = $query->getFromTable();
            $tableAlias     = $query->getFromAlias();
            $primaryKeyName = $this->structure->getPrimaryKey($tableTable);
            $query          = $query->where("$tableAlias.$primaryKeyName", $primaryKey);
        }

        return $query;
    }

    public function from($table, $primaryKey = null)
    {
        $args = func_get_args();

        return call_user_func_array(array($this, 'select'), $args);
    }

    /**
     * @param string $table
     * @param array $set
     * @param null $primaryKey
     * @return \UpdateQuery
     */
    public function update($table, $set = [], $primaryKey = null)
    {
        $query = new UpdateQuery($this, $table);
        $query->set($set);

        if ($primaryKey) {
            $primaryKeyName = $this->getStructure()->getPrimaryKey($table);
            $query          = $query->where($primaryKeyName, $primaryKey);
        }

        return $query;
    }

    /**
     * @param $table
     * @param array $values
     * @return InsertQuery
     */
    public function insert($table, $values = [])
    {
        $query = new InsertQuery($this, $table, $values);

        return $query;
    }

    public function insertInto($table, $values = [])
    {
        $args = func_get_args();

        return call_user_func_array(array($this, 'insert'), $args);
    }

    /**
     * @param string $table
     * @param null $primaryKey
     * @return DeleteQuery|\SelectQuery
     */
    public function delete($table, $primaryKey = null)
    {
        $query = new DeleteQuery($this, $table);
        if ($primaryKey) {
            $primaryKeyName = $this->getStructure()->getPrimaryKey($table);
            $query          = $query->where($primaryKeyName, $primaryKey);
        }

        return $query;
    }

    private function __clone() {}
}