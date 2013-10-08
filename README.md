Class Generation
================
[![Build Status](https://travis-ci.org/tonicospinelli/ClassGeneration.png?branch=1.0)](https://travis-ci.org/tonicospinelli/ClassGeneration)
[![Coverage Status](https://coveralls.io/repos/tonicospinelli/ClassGeneration/badge.png)](https://coveralls.io/r/tonicospinelli/ClassGeneration)

Introduction
============
When I developed a specific project, I saw an opportunity to create a library to generate Php Class Files and this was born.

Installation
============
I assume you know about Composer, if not see [Composer WebSite](http://getcomposer.org/).
```sh
$ php composer.phar require tonicospinelli/classgeneration:1.1.*
```
OR
```javascripti
{
    "tonicospinelli/classgeneration" : "1.1.*"
}
```

QUICK START
-----------

Using ClassGeneration is simple. Here's a simple example for creating a Php Class File. 

```php
$code = new \ClassGeneration\Builder();
$code
->setName('FirstClass')
->setNamespace('MyNamespace')
->setDescription('Class description')
->addProperty(new Property(array('name' => 'property')))
->save('./src');
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
