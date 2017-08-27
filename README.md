# PHPQueryBuilder
[![Build Status](https://travis-ci.org/ridaamirini/PHPQueryBuilder.svg?branch=master)](https://travis-ci.org/ridaamirini/PHPQueryBuilder) [![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%207.0-8892BF.svg)](https://php.net/) [![Latest Stable Version](https://poser.pugx.org/ridaamirini/phpbquerybuilder/v/stable)](https://packagist.org/packages/ridaamirini/phpbquerybuilder) [![Latest Unstable Version](https://poser.pugx.org/ridaamirini/phpbquerybuilder/v/unstable)](https://packagist.org/packages/ridaamirini/phpbquerybuilder) [![Code Climate](https://codeclimate.com/github/ridaamirini/PHPQueryBuilder/badges/gpa.svg)](https://codeclimate.com/github/ridaamirini/PHPQueryBuilder) [![Total Downloads](https://poser.pugx.org/ridaamirini/phpbquerybuilder/downloads)](https://packagist.org/packages/ridaamirini/phpbquerybuilder) [![MIT licensed](https://img.shields.io/badge/license-MIT-blue.svg)](https://raw.githubusercontent.com/hyperium/hyper/master/LICENSE) [![composer.lock](https://poser.pugx.org/ridaamirini/phpbquerybuilder/composerlock)](https://packagist.org/packages/ridaamirini/phpbquerybuilder)

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
		"ridaamirini/phpquerybuilder": "0.1.*"
	}

then update your dependencies with `composer update`.

OR

For the latest dev version 

    composer require ridaamirini/phpquerybuilder:dev-master
    
## Start usage

```php
$pdo = new PDO("mysql:dbname=fluentdb", "root");
$fpdo = new FluentPDO($pdo);
```

## First example

PHPQueryBuilder is easy to use:

```php
$query = $fpdo->from('article')
            ->where('published_at > ?', 2017)
            ->orderBy('published_at DESC')
            ->limit(5);
```
executed query is:

```mysql
SELECT article.*
FROM article
WHERE published_at > ?
ORDER BY published_at DESC
LIMIT 5
```

## Smart join builder (how to build queries)

If you want to join table you can use full sql join syntax. For example we would like to show list of articles with author name:

```php
$query = $fpdo->from('article')
              ->leftJoin('user ON user.id = article.user_id')
              ->select('user.name')
              ->getQuery();
```

It was not so much smart, was it? ;-) If your database uses convention for primary and foreign key names, you can write only:

```php
$query = $fpdo->from('article')->leftJoin('user')->select('user.name')->getQuery();
```

Smarter? May be. but **best practice how to write joins is not to write any joins ;-)**

```php
$query = $fpdo->from('article')->select('user.name')->getQuery();
```

All three commands create same query:

```mysql
SELECT article.*, user.name 
FROM article 
LEFT JOIN user ON user.id = article.user_id
```

## Simple CRUD Query Examples

##### SELECT

```php
$query = $fpdo->from('article')->where('id', 1);
// or shortly if you select one row by primary key
$query = $fpdo->from('user', 1);
```

##### INSERT

```php
$values = array('title' => 'article 1', 'content' => 'content 1');
$query = $fpdo->insertInto('article')->values($values)->execute();
// or shortly
$query = $fpdo->insertInto('article', $values)->execute();
```

##### UPDATE

```php
$set = array('published_at' => new FluentLiteral('NOW()'));
$query = $fpdo->update('article')->set($set)->where('id', 1)->execute();
// or shortly if you update one row by primary key
$query = $fpdo->update('article', $set, 1)->execute();
```

##### DELETE

```php
$query = $fpdo->deleteFrom('article')->where('id', 1)->execute();
// or shortly if you delete one row by primary key
$query = $fpdo->deleteFrom('article', 1)->execute();
```


## Licence

 [![MIT licensed](https://img.shields.io/badge/license-MIT-blue.svg)](https://raw.githubusercontent.com/hyperium/hyper/master/LICENSE)
