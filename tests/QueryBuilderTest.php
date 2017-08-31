<?php
use App\Builder\QueryBuilder;
use PHPUnit\Framework\TestCase;

/**
 * Created by PhpStorm.
 * User: ridaam
 * Date: 31.08.17
 * Time: 01:31
 */
class QueryBuilderTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    public function tearDown()
    {
        parent::tearDown();
    }

    public function testBasicOperationsSelect()
    {
        $query =  QueryBuilder::create()->select('user')->where('id > ?', 0)->orderBy('name');;
        $query = $query->where('name = ?', 'Marek');


        $expc = 'SELECT user.* FROM user WHERE id > 0 AND name = "Marek" ORDER BY name';
        $expc_pdo = 'SELECT user.* FROM user WHERE id > ? AND name = ? ORDER BY name';

        $this->assertEquals($expc,  $query->getQuery());
        $this->assertEquals($expc_pdo,  $query->getQueryPDO());
    }
}
