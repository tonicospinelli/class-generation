<?php

/**
 * ClassGeneration
 * Copyright (c) 2012 ClassGeneration
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 * @category   ClassGeneration
 * @package    ClassGeneration
 * @copyright  Copyright (c) 2012 ClassGeneration (https://github.com/tonicospinelli/ClassGeneration)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 * @version    ##VERSION##, ##DATE##
 */

namespace ClassGeneration;

use ClassGeneration\DocBlock\Tag;
use ClassGeneration\DocBlockInterface;
use ClassGeneration\Element\Documentary;
use ClassGeneration\Element\ElementAbstract;
use ClassGeneration\Element\StaticInterface;
use ClassGeneration\Element\VisibilityInterface;

/**
 * Property ClassGeneration
 * @category   ClassGeneration
 * @package    ClassGeneration
 * @copyright  Copyright (c) 2012 ClassGeneration (https://github.com/tonicospinelli/ClassGeneration)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 * @version    ##VERSION##, ##DATE##
 */
class Property extends ElementAbstract implements VisibilityInterface, StaticInterface, Documentary
{

    /**
     * Property's name
     * @var string
     */
    protected $name;

    /**
     * Property's value.
     * @var mixed
     */
    protected $value;

    /**
     * Property's type.
     * @var string
     */
    protected $type;

    /**
     * Element Visibility.
     * @var string
     */
    protected $visibility;

    /**
     * Element is static.
     * @var bool
     */
    protected $isStatic;

    /**
     * Documentation Block
     * @var DocBlockInterface
     */
    protected $docBlock;

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        $this->setDocBlock(new DocBlock())
            ->setVisibility(Visibility::TYPE_PUBLIC);
    }

    /**
     * Gets the property's name
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
     * @return Property
     */
    public function setName($name)
    {
        $this->name = (string)$name;

        return $this;
    }

    /**
     * Gets the property's value.
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Check the property's value.
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
     * @throws \InvalidArgumentException
     * @return Property
     */
    public function setValue($value)
    {
        if (is_object($value)) {
            throw new \InvalidArgumentException('Object is not allowed in value for Property.');
        }
        $this->value = $value;

        return $this;
    }

    /**
     * Gets the property's type.
     * @return string
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
     * @return Property
     */
    public function setType($type)
    {
        $this->type = (string)$type;
        $this->getDocBlock()->getTagCollection()->removeByName('var');
        $tag = new Tag(
            array(
                'name' => Tag::TAG_VAR,
                'type' => $this->type
            )
        );
        $this->getDocBlock()->addTag($tag);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getDocBlock()
    {
        return $this->docBlock;
    }

    /**
     * {@inheritdoc}
     * @return Property
     */
    public function setDocBlock(DocBlockInterface $docBlock)
    {
        $this->docBlock = $docBlock;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getVisibility()
    {
        return $this->visibility;
    }

    /**
     * {@inheritdoc}
     * @return Property
     */
    public function setVisibility($visibility)
    {
        Visibility::isValid($visibility);
        $this->visibility = $visibility;

        return $this;
    }

    /**
     * Is a static element?
     * @return bool
     */
    public function isStatic()
    {
        return $this->isStatic;
    }

    /**
     * Sets this property like static
     *
     * @param bool $isStatic
     *
     * @return Property
     */
    public function setIsStatic($isStatic = true)
    {
        $this->isStatic = (bool)$isStatic;

        return $this;
    }

    /**
     * Gets a description
     * @return string
     */
    public function getDescription()
    {
        return $this->getDocBlock()->getDescription();
    }

    /**
     * Sets a description.
     *
     * @param $description
     *
     * @return Property
     */
    public function setDescription($description)
    {
        $this->getDocBlock()->setDescription($description);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function toString()
    {
        $static = '';
        if ($this->isStatic()) {
            $static = 'static ';
        }

        $value = '';
        if ($this->hasValue()) {
            $value = ' = ' . var_export($this->getValue(), true);
        }

        $property = $this->getDocBlock()->toString() . $this->getTabulationFormatted()
            . $this->getVisibility() . ' '
            . $static
            . '$' . $this->getName()
            . $value
            . ';' . PHP_EOL;

        return $property;
    }
}
