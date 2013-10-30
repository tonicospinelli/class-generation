Class Generation
================
[![Build Status](https://travis-ci.org/tonicospinelli/ClassGeneration.png?branch=2.0)](https://travis-ci.org/tonicospinelli/ClassGeneration)
[![Scrutinizer Quality Score](https://scrutinizer-ci.com/g/tonicospinelli/ClassGeneration/badges/quality-score.png?s=da4a9d5122cb384c993cc53d21fa83ceaa29165e)](https://scrutinizer-ci.com/g/tonicospinelli/ClassGeneration/)
[![Code Coverage](https://scrutinizer-ci.com/g/tonicospinelli/ClassGeneration/badges/coverage.png?s=6c796c027334af623359abfb442aa3cccb05ed80)](https://scrutinizer-ci.com/g/tonicospinelli/ClassGeneration/)

[![Latest Stable Version](https://poser.pugx.org/tonicospinelli/classgeneration/v/stable.png)](https://packagist.org/packages/tonicospinelli/classgeneration)
[![Total Downloads](https://poser.pugx.org/tonicospinelli/classgeneration/downloads.png)](https://packagist.org/packages/tonicospinelli/classgeneration)

Introduction
============
When I developed a specific project, I saw an opportunity to create a library
to generate Php Class Files and this library was born.

Installation
============
I assume you know about Composer, if not look at [Composer WebSite](http://getcomposer.org/).
```sh
$ php composer.phar require tonicospinelli/classgeneration:2.0.*
```
OR
```json
{
    "tonicospinelli/classgeneration" : "2.0.*"
}
```

QUICK START
-----------

ClassGeneration is simple to use. Here's a sample for creating a Php Class File.

```php
<?php
require_once "../vendor/autoload.php";

use ClassGeneration\NamespaceClass;
use ClassGeneration\PhpClass;
use ClassGeneration\Property;
use ClassGeneration\Writer;

$code = new PhpClass();
$code
    ->setName('FirstClass')
    ->setNamespace(new NamespaceClass('MyNamespace'))
    ->setDescription('Class description')
    ->addProperty(new Property(array('name' => 'property')))
    ->generateGettersAndSettersFromProperties();

$writer = new Writer();
$writer
    ->setPhpClass($code)
    ->setPath('./src')
    ->write();
```
Result: ./src/MyNamespace/FirstClass.php
```php
<?php

namespace MyNamespace;

/**
 * Class description
 * @name FirstClass
 */
class FirstClass
{

    public $property;

    public function getProperty()
    {
        return $this->property;
    }

    public function setProperty($property)
    {
        $this->property = $property;

        return $this;
    }
}

```
Version
----
2.0

MIT License
----
*Free Software, Hell Yeah!*
