<?php

/**
 * ClassGeneration
 *
 * Copyright (c) 2012 ClassGeneration
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @category   ClassGeneration
 * @package    ClassGeneration
 * @copyright  Copyright (c) 2012 ClassGeneration (https://github.com/tonicospinelli/ClassGeneration)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 * @version    ##VERSION##, ##DATE##
 */

namespace ClassGeneration;

use ClassGeneration\PhpClassAbstract;
use ClassGeneration\DocBlock\Tag;

/**
 * Property ClassGeneration
 *
 * @category   ClassGeneration
 * @package    ClassGeneration
 * @copyright  Copyright (c) 2012 ClassGeneration (https://github.com/tonicospinelli/ClassGeneration)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 * @version    ##VERSION##, ##DATE##
 */
class Property extends PhpClassAbstract
{

    /**
     * Property's name
     *
     * @var string
     */
    protected $name;

    /**
     * Property's value.
     *
     * @var mixed
     */
    protected $value;

    /**
     * Property's type.
     *
     * @var string
     */
    protected $type;

    /**
     * Initialize.
     */
    public function init()
    {
        $this->setVisibility(\ClassGeneration\Visibility::TYPE_PUBLIC);
    }

    /**
     * Gets the property's name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets the property's name.
     *
     * @param string $name
     *
     * @return \ClassGeneration\Property
     */
    public function setName($name)
    {
        $this->name = (string)$name;

        return $this;
    }

    /**
     * Gets the property's value.
     *
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Check the property's value.
     *
     * @return boolean
     */
    public function hasValue()
    {
        return (!is_null($this->value) OR !empty($this->value));
    }

    /**
     * Sets the property's value.
     *
     * @param mixed $value
     *
     * @return \ClassGeneration\Property
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Gets the property's type.
     *
     * @return \ClassGeneration\DocBlock\Tag
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Sets the property's type.
     *
     * @param string $type
     *
     * @return \ClassGeneration\Property
     */
    public function setType($type)
    {
        $this->type = (string)$type;
        $this->docBlock->removeTagsByName('var');
        $tag = new Tag(
            array(
                'name' => Tag::TAG_VAR,
                'type' => $this->type
            )
        );
        $this->docBlock->addTag($tag);

        return $this;
    }

    /**
     * Sets the property's description.
     *
     * @param string $description
     *
     * @return \ClassGeneration\Property
     */
    public function setDescription($description)
    {
        $this->docBlock->setDescription($description);

        return $this;
    }

    /**
     * Gets the property's description.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->docBlock->getDescription();
    }

    /**
     * Sets the docBlock.
     *
     * @param \ClassGeneration\DocBlock $docBlock
     *
     * @return \ClassGeneration\Property
     */
    public function setDocBlock(\ClassGeneration\DocBlock $docBlock)
    {
        $this->docBlock = $docBlock;

        return $this;
    }

    /**
     * Parse the property string;
     *
     * @return string
     */
    public function toString()
    {
        return $this->__toString();
    }

    /**
     * Parse the property string;
     *
     * @return string
     */
    public function __toString()
    {
        $static = '';
        if ($this->isStatic()) {
            $static = 'static ';
        }

        $value = '';
        if ($this->hasValue()) {
            $value = ' = ' . $this->maskValue($this->getValue());
        }

        $property = $this->docBlock->toString() . $this->getTabulationFormatted()
            . $this->getVisibility() . ' '
            . $static
            . '$' . $this->getName()
            . $value
            . ';' . PHP_EOL;


        return $property;
    }
}
