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

use ClassGeneration\DocBlock;
use ClassGeneration\DocBlock\Tag;
use ClassGeneration\DocBlock\TagCollection;
use ClassGeneration\Property;

class DocBlockTest extends \PHPUnit_Framework_TestCase
{

    public function testCreatingInstanceOfDocBlock()
    {
        $docBlock = new DocBlock();
        $this->assertInstanceOf('\ClassGeneration\DocBlock', $docBlock);
    }

    public function testGetDescription()
    {
        $docBlock = new DocBlock();
        $docBlock->setOptions(array('description' => 'test'));
        $this->assertEquals('test', $docBlock->getDescription());
    }

    public function testSetDescription()
    {
        $docBlock = new DocBlock();
        $docBlock->setDescription('test');
        $this->assertEquals('test', $docBlock->getDescription());
    }

    public function testSetOptions()
    {
        $docBlock = new DocBlock();
        $docBlock->setOptions(array('description' => 'test'));
        $this->assertEquals('test', $docBlock->getDescription());
    }


    public function testAddTag()
    {
        $docBlock = new DocBlock();
        $tag = new Tag();
        $docBlock->addTag($tag);
        $this->assertCount(1, $docBlock->getTagCollection());
    }

    public function testSetTagCollection()
    {
        $docBlock = new DocBlock();
        $docBlock->setTagCollection(new TagCollection(array(new Tag())));
        $this->assertCount(1, $docBlock->getTagCollection());
    }

    public function testRemoveTagsByName()
    {
        $docBlock = new DocBlock();
        $docBlock->setTagCollection(
            new TagCollection(
                array(
                    new Tag(array('name' => 'param')),
                    new Tag(array('name' => 'return')),
                )
            )
        );
        $this->assertCount(2, $docBlock->getTagCollection());
        $docBlock->removeTagsByName('return');
        $this->assertCount(1, $docBlock->getTagCollection());
    }

    public function testRemoveTagsByReference()
    {
        $docBlock = new DocBlock();
        $property = new Property(array('name' => 'test'));
        $docBlock->setTagCollection(
            new TagCollection(
                array(
                    new Tag(array('name' => 'param', 'referenced' => $property)),
                    new Tag(array('name' => 'param', 'referenced' => $property)),
                    new Tag(array('name' => 'param')),
                )
            )
        );
        $this->assertCount(3, $docBlock->getTagCollection());
        $docBlock->removeTagsByReference($property);
        $this->assertCount(1, $docBlock->getTagCollection());
    }

    public function testGetTagsByName()
    {
        $docBlock = new DocBlock();
        $docBlock->setTagCollection(
            new TagCollection(
                array(
                    new Tag(array('name' => 'param')),
                    new Tag(array('name' => 'return')),
                    new Tag(array('name' => 'param')),
                    new Tag(array('name' => 'internal')),
                )
            )
        );
        $this->assertCount(4, $docBlock->getTagCollection());
        $this->assertCount(2, $docBlock->getTagsByName('param'));
        $this->assertCount(2, $docBlock->getTagsByName(array('return', 'internal')));
    }

    public function testGetTabulation()
    {
        $docBlock = new DocBlock();
        $this->assertEquals(4, $docBlock->getTabulation());
    }

    public function testGetTabulationFormatted()
    {
        $docBlock = new DocBlock();
        $expected = str_repeat(' ', $docBlock->getTabulation());
        $this->assertEquals($expected, $docBlock->getTabulationFormatted());
    }

    public function testSetTabulation()
    {
        $docBlock = new DocBlock();
        $this->assertEquals(4, $docBlock->getTabulation());
        $docBlock->setTabulation(2);
        $this->assertEquals(2, $docBlock->getTabulation());
    }

    public function testParseDocBlockToStringWithDescription()
    {
        $docBlock = new DocBlock();
        $docBlock->setDescription('test');
        $expected = PHP_EOL
            . '    /**' . PHP_EOL
            . '     * test' . PHP_EOL
            . '     */' . PHP_EOL;

        $this->assertEquals($expected, $docBlock->toString());
    }
    public function testParseDocBlockToStringWithDescriptionAndTag()
    {
        $docBlock = new DocBlock();
        $docBlock->setDescription('test')
            ->addTag(new Tag(array('name' => 'param')));
        $expected = PHP_EOL
            . '    /**' . PHP_EOL
            . '     * test' . PHP_EOL
            . '     * @param mixed' . PHP_EOL
            . '     */' . PHP_EOL;

        $this->assertEquals($expected, $docBlock->toString());
    }
}
