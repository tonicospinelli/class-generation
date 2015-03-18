Class Generation
================
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/a6437c70-d1df-4586-98d0-1faa92066f63/small.png)](https://insight.sensiolabs.com/projects/a6437c70-d1df-4586-98d0-1faa92066f63)
[![Build Status](https://travis-ci.org/tonicospinelli/ClassGeneration.png?branch=2.0)](https://travis-ci.org/tonicospinelli/ClassGeneration)
[![Scrutinizer Quality Score](https://scrutinizer-ci.com/g/tonicospinelli/ClassGeneration/badges/quality-score.png?s=8ffe9768f12e9d6f01d57ca3981e47eb745563a2)](https://scrutinizer-ci.com/g/tonicospinelli/ClassGeneration/)
[![Code Coverage](https://scrutinizer-ci.com/g/tonicospinelli/ClassGeneration/badges/coverage.png?s=9c6c165f53058acfd2ff350a1f4ba7c77a6a1395)](https://scrutinizer-ci.com/g/tonicospinelli/ClassGeneration/)

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
$ php composer.phar require tonicospinelli/classgeneration:2.2.*
```
OR
```json
{
    "tonicospinelli/classgeneration" : "2.2.*"
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
2.2

MIT License
----
*Free Software, Hell Yeah!*
