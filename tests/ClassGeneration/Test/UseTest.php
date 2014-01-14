<?php

/*
 * This file is part of the ClassGeneration package.
 *
 * (c) Antonio Spinelli <tonicospinelli@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ClassGeneration\Test;

use ClassGeneration\DocBlock\Tag;
use ClassGeneration\PhpClass;
use ClassGeneration\UseClass;

class UseTest extends \PHPUnit_Framework_TestCase
{

    public function testCreatingInstanceOfUseClass()
    {
        $use = new UseClass();
        $this->assertInstanceOf('\ClassGeneration\UseClass', $use);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testSetAndGetParent()
    {
        $code = new PhpClass();
        $use = new UseClass();
        $use->setOptions(array('parent' => $code));
        $this->assertInstanceOf('\ClassGeneration\PhpClass', $use->getParent());
        $use->setParent(new Tag());
    }

    public function testParseToStringWithoutAlias()
    {
        $use = new UseClass();
        $use->setClassName('ClassGeneration\Code');
        $expected = 'use ClassGeneration\Code;' . PHP_EOL;
        $this->assertEquals($expected, $use->toString());
    }

    public function testParseToStringWithAlias()
    {
        $use = new UseClass();
        $use->setClassName('ClassGeneration\Code')
            ->setAlias('MyCode');
        $expected = 'use ClassGeneration\Code as MyCode;' . PHP_EOL;
        $this->assertEquals($expected, $use->toString());
    }
}
