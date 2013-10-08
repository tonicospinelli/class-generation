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

use ClassGeneration\Element\ElementAbstract;
use ClassGeneration\Element\ElementInterface;

/**
 * Use ClassGeneration
 * @category   ClassGeneration
 * @package    ClassGeneration
 * @copyright  Copyright (c) 2012 ClassGeneration (https://github.com/tonicospinelli/ClassGeneration)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 * @version    ##VERSION##, ##DATE##
 */
class UseClass extends ElementAbstract implements UseInterface
{

    /**
     * The class name.
     * @var string
     */
    protected $className;

    /**
     * The alias for class name.
     * @var string
     */
    protected $alias;

    /**
     * @inheritdoc
     */
    public function init()
    {
    }

    /**
     * @inheritdoc
     * @return PhpClassInterface
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @inheritdoc
     * @return UseInterface
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
    public function setAlias($alias)
    {
        $this->alias = (string)$alias;

        return $this;
    }

    /**
     * Gets the alias name.
     * @return string
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * @inheritdoc
     */
    public function hasAlias()
    {
        $alias = $this->getAlias();

        return (!is_null($alias) and !empty($alias));
    }

    /**
     * @inheritdoc
     */
    public function setClassName($className)
    {
        $this->className = (string)$className;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getClassName()
    {
        return $this->className;
    }

    /**
     * @inheritdoc
     */
    public function toString()
    {

        $implements = 'use '
            . $this->getClassName()
            . ($this->hasAlias() ? ' as ' . $this->getAlias() : '')
            . ';' . PHP_EOL;

        return $implements;
    }
}
