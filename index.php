<?php
/**
 * Created by PhpStorm.
 * User: Rida Amirini
 * Date: 26.08.2017
 * Time: 01:58
 */

require 'vendor/autoload.php';

use App\Builder\QueryBuilder;
use App\Utils\QueryBuilderLiteral;


$select = QueryBuilder::create()->select('hans')
                                ->where('published_at > ?', 1)
                                ->where('pab = ?', 5)
                                ->orderBy('published_at DESC')
                                ->limit(5)
                                ->getQuery();

var_dump($select);


$update = QueryBuilder::create()->update('hans')
                                ->set(['published_at' => new QueryBuilderLiteral('NOW()')])
                                ->where('id', 1)
                                ->where('af', 13)
                                ->getQuery();

var_dump($update);


$insert = QueryBuilder::create()->insert('hans')
                                ->values(['title' => 'article 1', 'content' => 'content 1'])
                                ->getQuery();

var_dump($insert);



$delete = QueryBuilder::create()->delete('hans')
                                ->where('id', 1)
                                ->where('af', 13)
                                ->getQuery();

var_dump($delete);

//@todo Collection of Queries as sqldump or only query
//@todo CLI