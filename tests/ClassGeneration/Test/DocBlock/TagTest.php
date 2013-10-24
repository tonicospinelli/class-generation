<?php

/*
 * This file is part of the ClassGeneration package.
 *
 * (c) Antonio Spinelli <tonicospinelli@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ClassGeneration\Test\DocBlock;

use ClassGeneration\DocBlock\Tag;
use ClassGeneration\Property;

class TagTest extends \PHPUnit_Framework_TestCase
{

    public function testCreatingAnInstanceOfTagDocblock()
    {
        $tag = new Tag();
        $this->assertInstanceOf('\ClassGeneration\Element\ElementAbstract', $tag);
        $this->assertInstanceOf('\ClassGeneration\Element\ElementInterface', $tag);
        $this->assertInstanceOf('\ClassGeneration\DocBlock\Tag', $tag);
    }

    public function testSetOptions()
    {
        $tag = new Tag();
        $tag->setOptions(
            array(
                'name'        => Tag::TAG_ABSTRACT,
                'description' => 'Test Description'
            )
        );
        $this->assertEquals('abstract', $tag->getName());
    }

    public function testSetAndGetName()
    {
        $tag = new Tag();
        $tag->setName('param');
        $this->assertEquals('param', $tag->getName());
    }

    public function testSetAndGetType()
    {
        $tag = new Tag(array('type' => 'int'));
        $this->assertEquals('int', $tag->getType());
    }

    public function testSetAndGetVariable()
    {
        $tag = new Tag(array('variable' => 'test'));
        $this->assertEquals('test', $tag->getVariable());
    }

    public function testSetAndGetDescription()
    {
        $tag = new Tag(array('description' => 'test description'));
        $this->assertEquals('test description', $tag->getDescription());
    }

    public function testSetAndGetReferenced()
    {
        $tag = new Tag(array('referenced' => new Property()));
        $this->assertInstanceOf('\ClassGeneration\Property', $tag->getReferenced());
    }

    public function testSetAndGetIsInline()
    {
        $tag = new Tag(array('isInline' => true));
        $this->assertTrue($tag->isInline());
    }

    public function testParseTagToString()
    {
        $tag = new Tag();
        $tag->setName(Tag::TAG_PROPERTY)
            ->setType('int')
            ->setDescription('property description');
        $this->assertEquals('@property int property description' . PHP_EOL, $tag->toString());
    }

    public function testParseTagInlineToString()
    {
        $tag = new Tag();
        $tag->setName(Tag::TAG_PROPERTY)
            ->setType('int')
            ->setDescription('property description')
            ->setIsInline();
        $this->assertEquals('{@property int property description}' . PHP_EOL, $tag->toString());
    }
}
