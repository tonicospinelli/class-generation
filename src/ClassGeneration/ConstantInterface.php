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
 * Constants ClassGeneration
 * @category   ClassGeneration
 * @package    ClassGeneration
 * @copyright  Copyright (c) 2012 ClassGeneration (https://github.com/tonicospinelli/ClassGeneration)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 * @version    ##VERSION##, ##DATE##
 */
interface ConstantInterface extends ElementInterface
{

    /**
     * Gets the constant's name
     * @return string
     */
    public function getName();

    /**
     * Sets Constant Value.
     *
     * @param mixed $value Set the value in simple types: integer, float, string or boolean.
     *
     * @throws \InvalidArgumentException
     * @return Constant
     */
    public function setValue($value);

    /**
     * Sets the constant's name.
     *
     * @param string $name
     *
     * @return \ClassGeneration\Constant
     */
    public function setName($name);

    /**
     * Gets the Constant Value.
     * @return integer|float|string|boolean
     */
    public function getValue();

    /**
     * Sets the constant's description.
     *
     * @param string $description
     *
     * @return Constant
     */
    public function setDescription($description);

    /**
     * Gets the constant's description.
     * @return string
     */
    public function getDescription();
}
