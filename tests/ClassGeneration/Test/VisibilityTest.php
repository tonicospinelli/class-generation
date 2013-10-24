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

use ClassGeneration\Visibility;

class VisibilityTest extends \PHPUnit_Framework_TestCase
{

    public function testPublic()
    {
        $this->assertEquals('public', Visibility::TYPE_PUBLIC);
    }

    public function testPrivate()
    {
        $this->assertEquals('private', Visibility::TYPE_PRIVATE);
    }

    public function testProtected()
    {
        $this->assertEquals('protected', Visibility::TYPE_PROTECTED);
    }

    public function testIsValid()
    {
        $this->assertTrue(Visibility::isValid('public'));
    }
}
