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

use ClassGeneration\Element\ElementInterface;

/**
 * Argument Interface
 * @category   ClassGeneration
 * @package    ClassGeneration
 * @copyright  Copyright (c) 2012 ClassGeneration (https://github.com/tonicospinelli/ClassGeneration)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 * @version    ##VERSION##, ##DATE##
 */
interface ArgumentInterface extends ElementInterface
{

    /**
     * Gets the property's name
     * @return string
     */
    public function getName();

    /**
     * Gets the property's name
     * @return string
     */
    public function getNameFormatted();

    /**
     * Sets the property's name.
     *
     * @param string $name
     *
     * @return \ClassGeneration\Argument
     */
    public function setName($name);

    /**
     * Gets the value.
     * @return string
     */
    public function getValue();

    /**
     * Sets the value.
     *
     * @param string $value
     *
     * @return \ClassGeneration\ArgumentInterface
     */
    public function setValue($value);

    /**
     * Check if this argument is optional.
     * @return bool
     */
    public function isOptional();

    /**
     * Sets the argument is optional.
     *
     * @param bool $isOptional
     *
     * @return \ClassGeneration\ArgumentInterface
     */
    public function setIsOptional($isOptional = true);

    /**
     * Gets the argument type.
     * @return string
     */
    public function getType();

    /**
     * Check if this argument has type and is a primitive type.
     * @return boolean
     */
    public function hasType();

    /**
     * Sets a argument type.
     *
     * @param string $type
     *
     * @return \ClassGeneration\Argument
     */
    public function setType($type);

    /**
     * Get the argument description.
     * @return string
     */
    public function getDescription();

    /**
     * Sets the argument description.
     *
     * @param string $description
     *
     * @return \ClassGeneration\ArgumentInterface
     */
    public function setDescription($description);
}
