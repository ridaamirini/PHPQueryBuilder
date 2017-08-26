<?php

use App\Builder\QueryBuilder;

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

return  $collection;
