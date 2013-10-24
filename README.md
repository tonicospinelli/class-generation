Class Generation
================
[![Build Status](https://travis-ci.org/tonicospinelli/ClassGeneration.png?branch=1.0)](https://travis-ci.org/tonicospinelli/ClassGeneration)
[![Scrutinizer Quality Score](https://scrutinizer-ci.com/g/tonicospinelli/ClassGeneration/badges/quality-score.png?s=da4a9d5122cb384c993cc53d21fa83ceaa29165e)](https://scrutinizer-ci.com/g/tonicospinelli/ClassGeneration/)
[![Code Coverage](https://scrutinizer-ci.com/g/tonicospinelli/ClassGeneration/badges/coverage.png?s=6c796c027334af623359abfb442aa3cccb05ed80)](https://scrutinizer-ci.com/g/tonicospinelli/ClassGeneration/)

[![Latest Stable Version](https://poser.pugx.org/tonicospinelli/ClassGeneration/v/stable.png)](https://packagist.org/packages/tonicospinelli/ClassGeneration)
[![Total Downloads](https://poser.pugx.org/tonicospinelli/ClassGeneration/downloads.png)](https://packagist.org/packages/tonicospinelli/ClassGeneration)

Introduction
============
When I developed a specific project, I saw an opportunity to create a library to generate Php Class Files and this was born.

Installation
============
I assume you know about Composer, if not look at [Composer WebSite](http://getcomposer.org/).
```sh
$ php composer.phar require tonicospinelli/classgeneration:1.1.*
```
OR
```json
{
    "tonicospinelli/classgeneration" : "1.1.*"
}
```

QUICK START
-----------

Using ClassGeneration is simple. Here's a simple example for creating a Php Class File. 

```php
$code = new \ClassGeneration\PhpClass();
$code
    ->setName('FirstClass')
    ->setNamespace('MyNamespace')
    ->setDescription('Class description')
    ->addProperty(new Property(array('name' => 'property')))
    ->generateGettersAndSettersFromProperties()

$writer = new \ClassGenereation\Writer();
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

    /**
     *
     * @param mixed $property
     * @return \MyNamespace\FirstClass
     */
    public function setProperty($property)
    {
        $this->property = $property;

        return $this;
    }

}
```
Version
----
1.1

MIT License
----
*Free Software, Hell Yeah!*
