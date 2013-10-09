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

use ClassGeneration\Collection\ArrayCollection;
use ClassGeneration\Collection\CollectionIterator;
use ClassGeneration\Element\ElementInterface;

/**
 * Use ClassGeneration
 * @category   ClassGeneration
 * @package    ClassGeneration
 * @copyright  Copyright (c) 2012 ClassGeneration (https://github.com/tonicospinelli/ClassGeneration)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 * @version    ##VERSION##, ##DATE##
 */
class UseCollection extends ArrayCollection implements ElementInterface
{

    protected $parent;

    /**
     * Initializes a new ArrayCollection.
     *
     * @param array $elements
     */
    public function __construct(array $elements = array())
    {
        parent::__construct($elements);
        $this->init();
    }

    /**
     * Adds a new Use on the collection.
     *
     * @param UseInterface $use
     *
     * @throws \InvalidArgumentException
     * @return bool
     */
    public function add($use)
    {
        if (!$use instanceof UseInterface) {
            throw new \InvalidArgumentException('This Property must be a instance of \ClassGeneration\UseInterface');
        }

        return parent::add($use);
    }

    /**
     * @inheritdoc
     * @return UseIterator|UseClass[]
     */
    public function getIterator()
    {
        return new UseIterator($this);
    }

    /**
     * Parse the Uses to string;
     * @return string
     */
    public function toString()
    {
        if ($this->count() < 1) {
            return '';
        }
        $uses = $this->getIterator();
        $string = '';
        foreach ($uses as $use) {
            $string .= $use->toString();
        }

        return $string;
    }

    /**
     * @inheritdoc
     */
    public function init()
    {
    }

    /**
     * @inheritdoc
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @inheritdoc
     */
    public function setParent(ElementInterface $parent)
    {
        if (!$parent instanceof PhpClassInterface) {
            throw new \InvalidArgumentException('Only accept instances from ClassGeneration\PhpClassInterface');
        }
        $this->parent = $parent;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function setOptions(array $options)
    {
        foreach ($options as $prop => $option) {
            $method = 'set' . ucfirst($prop);
            if (method_exists($this, $method)) {
                $this->$method($option);
            }
        }

        return $this;
    }
}
