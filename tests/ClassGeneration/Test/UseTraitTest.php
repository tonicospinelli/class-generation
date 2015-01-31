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
use ClassGeneration\UseTrait;

class UseTraitTest extends \PHPUnit_Framework_TestCase
{

    public function testCreatingInstanceOfUseTraitClass()
    {
        $useTrait = new UseTrait();
        $this->assertInstanceOf('\ClassGeneration\UseTrait', $useTrait);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testSetAndGetParent()
    {
        $code = new PhpClass();
        $use = new UseTrait();
        $use->setOptions(array('parent' => $code));
        $this->assertInstanceOf('\ClassGeneration\PhpClass', $use->getParent());
        $use->setParent(new Tag());
    }

    public function testParseToString()
    {
        $use = new UseTrait();
        $use->setName('\ClassGeneration\Test\Provider\ObjectTrait');
        $expected = '\ClassGeneration\Test\Provider\ObjectTrait';
        $this->assertEquals($expected, $use->toString());
    }
}
