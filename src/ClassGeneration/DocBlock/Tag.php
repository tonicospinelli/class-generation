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

namespace ClassGeneration\DocBlock;

use ClassGeneration\Collection\ArrayCollection;
use ClassGeneration\Element\ElementAbstract;
use ClassGeneration\Element\ElementInterface;

/**
 * Tag DocBlock ClassGeneration
 * @category   ClassGeneration
 * @package    ClassGeneration\DocBlock
 * @copyright  Copyright (c) 2012 ClassGeneration (https://github.com/tonicospinelli/ClassGeneration)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 * @version    ##VERSION##, ##DATE##
 */
class Tag extends ElementAbstract implements TagInterface
{

    /**
     * Tag Name.
     * @var string
     */
    protected $name;

    /**
     * Tag Type.
     * @var string
     */
    protected $type;

    /**
     * Define a parameter name.
     * @var string
     */
    protected $variable;

    /**
     * Tag Description.
     * @var string
     */
    protected $description;

    /**
     * Element Referenced.
     * @var ElementInterface
     */
    protected $referenced;

    /**
     * Tags containing type.
     * @var ArrayCollection
     */
    protected $tagNeedsType;

    /**
     * Inline documentation, that is to put {} around of the text.
     * @var boolean
     */
    protected $isInline = false;

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        $this->tagNeedsType = new ArrayCollection(
            array('access', 'param', 'property', 'method', 'return', 'throws', 'var')
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * {@inheritdoc}
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getType()
    {
        if ((is_null($this->type) or empty($this->type)) and $this->needsType()) {
            return 'mixed';
        }

        return $this->type;
    }

    /**
     * {@inheritdoc}
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getVariable()
    {
        return $this->variable;
    }

    /**
     * {@inheritdoc}
     */
    public function setVariable($variable)
    {
        $this->variable = $variable;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * {@inheritdoc}
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * This tag, has type?
     *
     * @return bool
     */
    protected function needsType()
    {
        return $this->tagNeedsType->contains($this->getName());
    }

    /**
     * {@inheritdoc}
     */
    public function getReferenced()
    {
        return $this->referenced;
    }

    /**
     * {@inheritdoc}
     */
    public function setReferenced(ElementInterface $referenced)
    {
        $this->referenced = $referenced;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function isInline()
    {
        return $this->isInline;
    }

    /**
     * {@inheritdoc}
     */
    public function setIsInline($isInline = true)
    {
        $this->isInline = (bool)$isInline;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function toString()
    {
        $name = $this->getName();
        $variable = $this->getVariable();
        $type = $this->getType();
        $description = $this->getDescription();
        $string =
            '@' . $name
            . ((!is_null($type) and !empty($type)) ? ' ' . $type : '')
            . ((!is_null($variable) and !empty($variable)) ? ' $' . $variable : '')
            . ((!is_null($description) and !empty($description)) ? ' ' . $description : '');

        $string = trim($string);
        if ($this->isInline()) {
            return '{' . $string . '}' . PHP_EOL;
        }

        return $string . PHP_EOL;
    }
}
