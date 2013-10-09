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

use ClassGeneration\DocBlock\TagInterface;
use ClassGeneration\Element\ElementInterface;

/**
 * Method ClassGeneration
 * @category   ClassGeneration
 * @package    ClassGeneration
 * @copyright  Copyright (c) 2012 ClassGeneration (https://github.com/tonicospinelli/ClassGeneration)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 * @version    ##VERSION##, ##DATE##
 */
interface MethodInterface extends ElementInterface
{

    /**
     * Gets the method's name
     * @return string
     */
    public function getName();

    /**
     * Sets the method's name.
     * The method name must be camelCase, with first char in lower
     * and other words with first char upper.
     *
     * @param string $name
     *
     * @return MethodInterface
     */
    public function setName($name);

    /**
     * Gets the Arguments Colletion.
     * @return ArgumentCollection
     */
    public function getArgumentCollection();

    /**
     * Add a new Argument Object.
     *
     * @param ArgumentInterface $argument
     *
     * @return MethodInterface
     */
    public function addArgument(ArgumentInterface $argument);

    /**
     * Arguments's list.
     *
     * @param ArgumentCollection $arguments \ClassGeneration\Arguments's array.
     *
     * @return MethodInterface
     */
    public function setArgumentCollection(ArgumentCollection $arguments);

    /**
     * Sets the property's description.
     *
     * @param string $description
     *
     * @return MethodInterface
     */
    public function setDescription($description);

    /**
     * Gets the property's description.
     * @return string
     */
    public function getDescription();

    /**
     * Sets the property's description.
     *
     * @param TagInterface $tag
     *
     * @return MethodInterface
     */
    public function setReturns(TagInterface $tag);

    /**
     * Sets the property's description.
     * @return TagInterface
     */
    public function getReturns();

    /**
     * Method's code
     * @return string
     */
    public function getCode();

    /**
     * Method's code
     *
     * @param string $code
     *
     * @return MethodInterface
     */
    public function setCode($code);
}
