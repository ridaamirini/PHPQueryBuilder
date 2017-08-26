<?php
/**
 * Created by PhpStorm.
 * User: Rida Amirini
 * Date: 26.08.2017
 * Time: 01:58
 */

ini_set('display_errors',  'On');
error_reporting(E_ALL);

require 'vendor/autoload.php';

use App\Builder\QueryBuilder;
use App\Utils\QueryBuilderLiteral;

$collection = new \App\Schema\QueryCollection();


QueryBuilder::create()->select('hans')
                      ->where('published_at > ?', 1)
                      ->where('pab = ?', 5)
                      ->orderBy('published_at DESC')
                      ->limit(5)
                      ->collect($collection);

QueryBuilder::create()->select('hans')
                      ->where('published_at > ?', 1)
                      ->where('pab = ?', 5)
                      ->orderBy('published_at DESC')
                      ->limit(5)
                      ->collect($collection);

QueryBuilder::create()->select('hans')
                      ->where('published_at > ?', 1)
                      ->where('pa2b = ?', 5)
                      ->orderBy('published_at DESC')
                      ->limit(224)
                      ->collect($collection);

$collection->dump(getcwd(). '/bla', 'bla', true);

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


$insertcollection = new \App\Schema\QueryCollection();


QueryBuilder::create()->insert('dome', ['hans' => 2123, 'dalsdk' => 'daiosdaiosdj'])->collect($insertcollection);
QueryBuilder::create()->insert('dome', ['han2s' => 2123, 'dalsdk' => 'daiosdaiosdj'])->collect($insertcollection);
QueryBuilder::create()->insert('dome', ['ha3ns' => 2123, 'dalsdk' => 'daiosdaiosdj'])->collect($insertcollection);
QueryBuilder::create()->insert('dome', ['ha4ns' => 2123, 'dalsdk' => 'daiosdaiosdj'])->collect($insertcollection);
QueryBuilder::create()->insert('dome', ['ha5ns' => 2123, 'dalsdk' => 'daiosdaiosdj'])->collect($insertcollection);

$insertcollection->dump(getcwd() . '/bla/', 'insert.sql');

QueryBuilder::create()->select('hans')
    ->where('published_at > ?', 1)
    ->where('pab = ?', 5)
    ->orderBy('published_at DESC')
    ->limit(5)
    ->collect($collection);

QueryBuilder::create()->select('hans')
    ->where('published_at > ?', 1)
    ->where('pa2b = ?', 5)
    ->orderBy('published_at DESC')
    ->limit(224)
    ->collect($collection);

$collection->dump(getcwd(). '/bla', 'bla', true);