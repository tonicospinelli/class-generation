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
use ClassGeneration\Element\Documentary;
use ClassGeneration\Element\ElementAbstract;

/**
 * Constants ClassGeneration
 * @category   ClassGeneration
 * @package    ClassGeneration
 * @copyright  Copyright (c) 2012 ClassGeneration (https://github.com/tonicospinelli/ClassGeneration)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 * @version    ##VERSION##, ##DATE##
 */
class Constant extends ElementAbstract implements Documentary
{

    /**
     * constant's name
     * @var string
     */
    protected $name;

    /**
     * @var mixed
     */
    protected $value;

    /**
     * Alloweds php types.
     * @var ArrayCollection
     */
    protected $allowedTypes;

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
        $this->docBlock = new DocBlock();
    }

    /**
     * Gets the constant's name
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets Constant Value.
     *
     * @param mixed $value Set the value in simple types: integer, float, string or boolean.
     *
     * @throws \InvalidArgumentException
     * @return \ClassGeneration\Constant
     */
    public function setValue($value)
    {
        if (!is_string($value) AND !is_numeric($value)) {
            throw new \InvalidArgumentException('The constant value must be a string or number');
        }
        $this->value = $value;

        return $this;
    }

    /**
     * Sets the constant's name.
     *
     * @param string $name
     *
     * @return \ClassGeneration\Constant
     */
    public function setName($name)
    {
        $this->name = (string)$name;

        return $this;
    }

    /**
     * Gets the Constant Value.
     * @return integer|float|string|boolean
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Sets the constant's description.
     *
     * @param string $description
     *
     * @return \ClassGeneration\Constant
     */
    public function setDescription($description)
    {
        $this->getDocBlock()->setDescription($description);

        return $this;
    }

    /**
     * Gets the constant's description.
     * @return string
     */
    public function getDescription()
    {
        return $this->getDocBlock()->getDescription();
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
     * @return \ClassGeneration\Constant
     */
    public function setDocBlock(DocBlockInterface $docBlock)
    {
        $this->docBlock = $docBlock;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function toString()
    {
        $constant = $this->getDocBlock()->toString()
            . $this->getTabulationFormatted()
            . 'const '
            . mb_strtoupper($this->getName())
            . ' = ' . var_export($this->getValue(), true)
            . ';' . PHP_EOL;

        return $constant;
    }
}
