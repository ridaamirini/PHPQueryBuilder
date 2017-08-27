# PHPQueryBuilder
[![Build Status](https://travis-ci.org/ridaamirini/PHPQueryBuilder.svg?branch=master)](https://travis-ci.org/ridaamirini/PHPQueryBuilder) [![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%207.0-8892BF.svg)](https://php.net/) [![Latest Stable Version](https://poser.pugx.org/ridaamirini/phpquerybuilder/v/stable)](https://packagist.org/packages/ridaamirini/phpquerybuilder) [![Latest Unstable Version](https://poser.pugx.org/ridaamirini/phpquerybuilder/v/unstable)](https://packagist.org/packages/ridaamirini/phpquerybuilder) [![Code Climate](https://codeclimate.com/github/ridaamirini/PHPQueryBuilder/badges/gpa.svg)](https://codeclimate.com/github/ridaamirini/PHPQueryBuilder) [![Total Downloads](https://poser.pugx.org/ridaamirini/phpquerybuilder/downloads)](https://packagist.org/packages/ridaamirini/phpbquerybuilder) [![MIT licensed](https://img.shields.io/badge/license-MIT-blue.svg)](https://raw.githubusercontent.com/hyperium/hyper/master/LICENSE) [![composer.lock](https://poser.pugx.org/ridaamirini/phpbquerybuilder/composerlock)](https://packagist.org/packages/ridaamirini/phpbquerybuilder)

An fast, small SQL Builder based on [FluentPDO](https://github.com/envms/fluentpdo)

## Features

- Simply create queries step by step
- Smart join builder
- Build SELECT, INSERT, UPDATE & DELETE queries
- Small and fast
- Type hinting with code completion in smart IDEs
- Requires PHP 7.0+
- PHP 5.6+ compatibility coming soon

## Install

### Composer

Add in your `composer.json`:

	"require": {
		...
		"ridaamirini/phpquerybuilder": "^0.1.1"
	}

then update your dependencies with `composer update`.

OR

For the latest dev version 

    composer require ridaamirini/phpquerybuilder:dev-master
    
## Start usage

PHPQueryBuilder is easy to use:

```php
QueryBuilder::create()->select('article')
                      ->where('published_at > ?', 1)
		      ->orderBy('published_at DESC')
		      ->limit(5)
		      ->getQuery();
```
output query is:

```mysql
SELECT article.* FROM article WHERE published_at > 1 ORDER BY published_at DESC LIMIT 5
```

## Smart join builder (how to build queries)

If you want to join table you can use full sql join syntax. For example we would like to show list of articles with author name:

```php
$query = QueryBuilder::create()->select('article')
                               ->leftJoin('user ON user.id = article.user_id')
                               ->select('user.name')
                               ->getQuery();
```

It was not so much smart, was it? ;-) If your database uses convention for primary and foreign key names, you can write only:

```php
$query = QueryBuilder::create()->select('article')->leftJoin('user')->select('user.name')->getQuery();
```

Smarter? May be. but **best practice how to write joins is not to write any joins ;-)**

```php
$query = QueryBuilder::create()->select('article')->select('user.name')->getQuery();
```

All three commands create same query:

```mysql
SELECT article.*, user.name FROM article LEFT JOIN user ON user.id = article.user_id
```

## Simple CRUD Query Examples

##### SELECT

```php
$query = QueryCollection::create()->select('article')->where('id', 1)->getQuery();
// or shortly if you select one row by primary key
$query = QueryCollection::create()->from('user', 1)->getQuery();
```

##### INSERT

```php
$values = ['title' => 'article 1', 'content' => 'content 1'];
$query = QueryCollection::create()->insert('article')->values($values)->getQuery();
// or shortly
$query = QueryCollection::create()->insert('article', $values)->getQuery();
```

##### UPDATE

```php
$set = ['published_at' => new QueryBuilderLiteral('NOW()')];
$query = QueryCollection::create()->update('article')->set($set)->where('id', 1)->getQuery();
// or shortly if you update one row by primary key
$query = QueryCollection::create()->update('article', $set, 1)->getQuery();
```

##### DELETE
```php
$query = QueryCollection::create()->delete('article')->where('id', 1)->getQuery();
// or shortly if you delete one row by primary key
$query = QueryCollection::create()->delete('article', 1)->getQuery();
```

## CRUD QueryCollection Examples and PHPQueryBuilder CLI

### Init config file
	$ vendor/bin/phpqb init
	
Insert your values (phpqb.json)	
```json
{
  "folder": [
    {
      "from": "./test",
      "to": "./db"
    }
  ],
  "files": [
    {
      "from": "./test.php",
      "to": "./db_2"
    }
  ],
  "excludes": [
    {
      "path": "./test/toExclude.php"
    },
    {
      "path": "./test/test_exclude"
    }
  ],
  "defaultDestination": "./path/to/default"
}
```
Run with config file

	$ vendor/bin/phpqb dump
		OR
	$ vendor/bin/phpqb dump --config
	
Run with path

	$ vendor/bin/phpqb dump --collection /path/to/collection.php > collection.sql
		OR
	$ vendor/bin/phpqb dump -c /path/to/collection.php --filename /path/to/output/output.sql
	
### Example File

```php
<?php

use App\Builder\QueryBuilder;
use App\Schema\QueryCollection;

$collection = new QueryCollection();

//SELECT
QueryCollection::create()->select('article')->where('id', 1)->collect($collection);

//INSERT
$values = ['title' => 'article 1', 'content' => 'content 1'];
$query = QueryCollection::create()->insert('article')->values($values)->collect($collection);

//UPDATE
$set = ['published_at' => 'yesterday'];
$query = QueryCollection::create()->update('article')->set($set)->where('id', 1)->getQuery();

//DELETE
QueryCollection::create()->delete('article')->where('id', 1)->collect($collection);

return $collection;
```
## TODO
- [ ] Standalone QueryBuilder wihtout FluentPDO
- [ ] PHP 5.6+ compatibility
- [ ] phpqb.json JSON lint
- [ ] Command phpqb dump -c ... -f **allow directory**
- [ ] Add Unit Tests
- [x] First release

## Licence

 [![MIT licensed](https://img.shields.io/badge/license-MIT-blue.svg)](https://raw.githubusercontent.com/hyperium/hyper/master/LICENSE)
