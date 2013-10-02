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

/**
 * Argument ClassGeneration
 *
 * @category   ClassGeneration
 * @package    ClassGeneration
 * @copyright  Copyright (c) 2012 ClassGeneration (https://github.com/tonicospinelli/ClassGeneration)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 * @version    ##VERSION##, ##DATE##
 */
class Argument extends BuilderAbstract
{

    /**
     * Argument's name.
     *
     * @var string
     */
    protected $name;

    /**
     * Argument's default value.
     *
     * @var mixed
     */
    protected $value;

    /**
     * Argument's is optional.
     *
     * @var bool
     */
    protected $isOptional = false;

    /**
     * Argument's description.
     *
     * @var string
     */
    protected $description;

    /**
     * Argument's type.
     *
     * @var string
     */
    protected $type;

    public function init()
    {
        $this->setIsOptional(false);
    }

    /**
     * Gets the property's name
     *
     * @param bool $formatted
     *
     * @return string
     */
    public function getName($formatted = false)
    {
        $name = $formatted ? '$' . $this->name : $this->name;

        return $name;
    }

    /**
     * Sets the property's name.
     *
     * @param string $name
     *
     * @return \ClassGeneration\Argument
     */
    public function setName($name)
    {
        $this->name = (string)$name;

        return $this;
    }

    /**
     * Gets the value.
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Sets the value.
     *
     * @param string $value
     *
     * @return \ClassGeneration\Argument
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Check if this argument is optional.
     *
     * @return bool
     */
    public function isOptional()
    {
        return $this->isOptional;
    }

    /**
     * Sets the argument is optional.
     *
     * @param bool $isOptional
     *
     * @return \ClassGeneration\Argument
     */
    public function setIsOptional($isOptional = true)
    {
        $this->isOptional = (bool)$isOptional;

        return $this;
    }

    /**
     * Gets the argument type.
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Check if this argument has type and is a primitive type.
     *
     * @return boolean
     */
    public function hasType()
    {
        $primitiveTypes = array(
            'array',
            'bool', 'boolean',
            'decimal', 'double',
            'float',
            'int', 'integer',
            'number',
            'string',
            'resource',
        );

        return (!is_null($this->type) OR !empty($this->type)) && !in_array(mb_strtolower($this->type), $primitiveTypes);
    }

    /**
     * Sets a argument type.
     *
     * @param string $type
     *
     * @return \ClassGeneration\Argument
     */
    public function setType($type)
    {
        $this->type = (string)$type;

        return $this;
    }

    /**
     * Get the argument description.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Sets the argument description.
     *
     * @param string $description
     *
     * @return \ClassGeneration\Argument
     */
    public function setDescription($description)
    {
        $this->description = $description;

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
        $type = '';
        if ($this->hasType()) {
            $type = $this->getType() . ' ';
        }
        $value = '';
        if ($this->isOptional()) {
            $value = ' = ' . $this->maskValue($this->getValue());
        }
        $argument = trim($type
            . $this->getName(true)
            . $value);

        return $argument;
    }
}
