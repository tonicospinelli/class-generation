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
 * Property ClassGeneration
 * @category   ClassGeneration
 * @package    ClassGeneration
 * @copyright  Copyright (c) 2012 ClassGeneration (https://github.com/tonicospinelli/ClassGeneration)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 * @version    ##VERSION##, ##DATE##
 */
interface PropertyInterface extends ElementInterface
{

    /**
     * Gets the property's name
     * @return string
     */
    public function getName();

    /**
     * Sets the property's name.
     *
     * @param string $name
     *
     * @return Property
     */
    public function setName($name);

    /**
     * Gets the property's value.
     * @return mixed
     */
    public function getValue();

    /**
     * Check the property's value.
     * @return boolean
     */
    public function hasValue();

    /**
     * Sets the property's value.
     *
     * @param mixed $value
     *
     * @throws \InvalidArgumentException
     * @return Property
     */
    public function setValue($value);

    /**
     * Gets the property's type.
     * @return string
     */
    public function getType();

    /**
     * Sets the property's type.
     *
     * @param string $type
     *
     * @return Property
     */
    public function setType($type);

    /**
     * Gets a description
     * @return string
     */
    public function getDescription();

    /**
     * Sets a description.
     *
     * @param $description
     *
     * @return Property
     */
    public function setDescription($description);
}
