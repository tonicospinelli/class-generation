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

/**
 * Method Collection ClassGeneration
 * @category   ClassGeneration
 * @package    ClassGeneration
 * @copyright  Copyright (c) 2012 ClassGeneration (https://github.com/tonicospinelli/ClassGeneration)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 * @version    ##VERSION##, ##DATE##
 */
class MethodCollection extends ArrayCollection
{

    /**
     * Adds a new Method on collection.
     *
     * @param MethodInterface $method
     *
     * @throws \InvalidArgumentException
     * @return bool
     */
    public function add($method)
    {
        if (!$method instanceof MethodInterface) {
            throw new \InvalidArgumentException('This Method must be a instance of \ClassGeneration\MethodInterface');
        }
        if ($method->getName() === null) {
            $method->setName('method' . ($this->count() + 1));
        }

        return parent::set($method->getName(), $method);
    }

    /**
     * Gets the Method Iterator.
     * @return MethodIterator|MethodInterface[]
     */
    public function getIterator()
    {
        return new MethodIterator($this);
    }

    /**
     * Parse the Method Collection to string.
     * @return string
     */
    public function toString()
    {
        $string = '';
        $methods = $this->getIterator();
        foreach ($methods as $method) {
            $string .= $method->toString();
        }

        return $string;
    }

    /**
     * Removes tags by name.
     *
     * @param $methodName
     *
     * @return MethodCollection Returns a collection with removed methods.
     */
    public function removeByName($methodName)
    {
        $removedList = new self();
        $list = $this->getIterator();
        foreach ($list as $index => $method) {
            if ((is_array($methodName) and in_array($method->getName(), $methodName))
                or ($method->getName() === $methodName)
            ) {
                $removedList->add($method);
                $this->remove($index);
            }
        }

        return $removedList;
    }
}
