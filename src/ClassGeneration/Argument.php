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

/**
 * Argument ClassGeneration
 * @category   ClassGeneration
 * @package    ClassGeneration
 * @copyright  Copyright (c) 2012 ClassGeneration (https://github.com/tonicospinelli/ClassGeneration)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 * @version    ##VERSION##, ##DATE##
 */
class Argument extends ElementAbstract implements ArgumentInterface
{

    /**
     * Argument's name.
     * @var string
     */
    protected $name;

    /**
     * Argument's default value.
     * @var mixed
     */
    protected $value;

    /**
     * Argument's is optional.
     * @var bool
     */
    protected $isOptional = false;

    /**
     * Argument's description.
     * @var string
     */
    protected $description;

    /**
     * Argument's type.
     * @var string
     */
    protected $type;

    /**
     * Primitive types.
     * @var array
     */
    protected $primitiveTypes = array(
        'array',
        'bool', 'boolean',
        'decimal', 'double',
        'float',
        'int', 'integer',
        'number',
        'string',
        'resource',
    );

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        $this->setIsOptional(false);
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
    public function getNameFormatted()
    {
        return '$' . $this->getName();
    }

    /**
     * {@inheritdoc}
     */
    public function setName($name)
    {
        $this->name = (string)$name;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * {@inheritdoc}
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function isOptional()
    {
        return $this->isOptional;
    }

    /**
     * {@inheritdoc}
     */
    public function setIsOptional($isOptional = true)
    {
        $this->isOptional = (bool)$isOptional;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * {@inheritdoc}
     */
    public function hasType()
    {
        return (!is_null($this->type) OR !empty($this->type)) && !in_array(mb_strtolower($this->type), $this->primitiveTypes);
    }

    /**
     * {@inheritdoc}
     */
    public function setType($type)
    {
        $this->type = (string)$type;

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
     * {@inheritdoc}
     */
    public function toString()
    {
        $type = '';
        if ($this->hasType()) {
            $type = $this->getType() . ' ';
        }
        $value = '';
        if ($this->isOptional()) {
            $value = ' = ' . var_export($this->getValue(), true);
        }
        $argument = $type
            . $this->getNameFormatted()
            . $value;

        return $argument;
    }
}
