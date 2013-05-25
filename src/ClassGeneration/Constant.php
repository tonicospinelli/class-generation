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

use ClassGeneration\Collection\ArrayCollection;

/**
 * Constants ClassGeneration
 *
 * @category   ClassGeneration
 * @package    ClassGeneration
 * @copyright  Copyright (c) 2012 ClassGeneration (https://github.com/tonicospinelli/ClassGeneration)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 * @version    ##VERSION##, ##DATE##
 */
class Constant extends BuilderAbstract
{

    /**
     * constant's name
     *
     * @var string
     */
    protected $name;

    /**
     *
     * @var mixed
     */
    protected $value;

    /**
     * Alloweds php types.
     *
     * @var ArrayCollection
     */
    protected $allowedTypes;

    /**
     * Initialize.
     */
    public function init()
    {
        $this->allowedTypes = new ArrayCollection(
            array(
                'boolean', 'bool',
                'double', 'decimal',
                'int', 'integer',
                'float',
                'string'
            )
        );
    }

    /**
     * Gets the constant's name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
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
     *
     * @return integer|float|string|boolean
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Sets Constant Value.
     *
     * @param mixed $value Set the value in simple types: integer, float, string or boolean.
     *
     * @return \ClassGeneration\Constant
     * @throws \RuntimeException
     */
    public function setValue($value)
    {
        $type = gettype($value);
        if (!$this->allowedTypes->contains($type)) {
            throw new \RuntimeException('This value type (' . $type . ') is not allowed on Constants');
        }
        $this->value = $value;

        return $this;
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
        $this->docBlock->setDescription($description);

        return $this;
    }

    /**
     * Gets the constant's description.
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
     * @param DocBlock $docBlock
     *
     * @return \ClassGeneration\Constant
     */
    public function setDocBlock(DocBlock $docBlock)
    {
        parent::setDocBlock($docBlock);
        $this->docBlock->clearAllTags();

        return $this;
    }

    /**
     * Parse the constant string;
     *
     * @return string
     */
    public function toString()
    {
        return $this->__toString();
    }

    /**
     * Parse the constant string;
     *
     * @return string
     */
    public function __toString()
    {
        $constant = $this->docBlock->toString()
            . $this->getTabulationFormatted()
            . 'const '
            . mb_strtoupper($this->getName())
            . ' = ' . $this->maskValue($this->getValue())
            . ';' . PHP_EOL;

        return $constant;
    }
}
