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

namespace ClassGeneration\Element;

use ClassGeneration\DocBlockInterface;

/**
 * Abstract ClassGeneration
 * @category   ClassGeneration
 * @package    ClassGeneration
 * @copyright  Copyright (c) 2012 ClassGeneration (https://github.com/tonicospinelli/ClassGeneration)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 * @version    ##VERSION##, ##DATE##
 */
abstract class ElementAbstract implements ElementInterface, Tabbable
{

    /**
     * Tabulation Identity.
     * @var int
     */
    protected $tabulation = 4;

    /**
     * Parent Class.
     * @var ElementInterface
     */
    protected $parent = null;

    /**
     * Documentation Block.
     * @var DocBlockInterface
     */
    protected $docBlock;

    /**
     * Element is static.
     * @var bool
     */
    protected $isFinal;


    /**
     * Element is abstract.
     * @var bool
     */
    protected $isAbstract;

    abstract public function init();

    abstract public function toString();

    public function __construct($options = array())
    {
        $this->init();
        $this->setOptions($options);
    }

    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * {@inheritdoc}
     */
    public function setParent(ElementInterface $parent)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * {@inheritdoc}
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

    /**
     * {@inheritdoc}
     */
    public function getTabulation()
    {
        return $this->tabulation;
    }

    /**
     * {@inheritdoc}
     */
    public function getTabulationFormatted()
    {
        return str_repeat(' ', $this->getTabulation());
    }

    /**
     * {@inheritdoc}
     */
    public function setTabulation($tabulation)
    {
        $this->tabulation = (int)$tabulation;

        return $this;
    }
}
