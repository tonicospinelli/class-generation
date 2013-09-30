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
 * Interface for Class Elements ClassGeneration
 * @category   ClassGeneration
 * @package    ClassGeneration
 * @copyright  Copyright (c) 2012 ClassGeneration (https://github.com/tonicospinelli/ClassGeneration)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 * @version    ##VERSION##, ##DATE##
 */
interface ClassInterface extends ElementInterface
{

    /**
     * Is a final element?
     * @return boolean
     */
    public function isFinal();

    /**
     * Sets this class is final.
     *
     * @param boolean $isFinal
     *
     * @return ElementInterface
     */
    public function setIsFinal($isFinal = true);

    /**
     * Is a abstract element?
     * @return boolean
     */
    public function isAbstract();

    /**
     * Sets this class is abstract.
     *
     * @param boolean $isAbstract
     *
     * @return ElementInterface
     */
    public function setIsAbstract($isAbstract = true);
}