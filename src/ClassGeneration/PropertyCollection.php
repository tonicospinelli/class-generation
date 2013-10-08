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
 * Property Collection ClassGeneration
 * @category   ClassGeneration
 * @package    ClassGeneration
 * @copyright  Copyright (c) 2012 ClassGeneration (https://github.com/tonicospinelli/ClassGeneration)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 * @version    ##VERSION##, ##DATE##
 */
class PropertyCollection extends ArrayCollection
{

    /**
     * Adds a new Property on the collection.
     *
     * @param PropertyInterface $property
     *
     * @throws \InvalidArgumentException
     * @return bool
     */
    public function add($property)
    {
        if (!$property instanceof PropertyInterface) {
            throw new \InvalidArgumentException(
                'This Property must be a instance of \ClassGeneration\PropertyInterface'
            );
        }
        if ($property->getName() === null) {
            $property->setName('property' . ($this->count() + 1));
        }

        return parent::add($property);
    }

    /**
     * Gets the current Property.
     * @return Property
     */
    public function current()
    {
        return parent::current();
    }

    /**
     * Gets the Property Iterator.
     * @return PropertyIterator|Property[]
     */
    public function getIterator()
    {
        return new PropertyIterator($this->toArray());
    }

    /**
     * Parse the Property Collection to string.
     * @return string
     */
    public function toString()
    {
        $string = '';
        $properties = $this->getIterator();
        foreach ($properties as $property) {
            $string .= $property->toString();
        }

        return $string;
    }

    /**
     * Find the properties by name.
     *
     * @param string $propertyName
     *
     * @return PropertyCollection
     */
    public function getByName($propertyName)
    {
        $foundList = new self();
        $list = $this->getIterator();
        foreach ($list as $property) {
            if ((is_array($propertyName) and in_array($property->getName(), $propertyName))
                or($property->getName() === $propertyName)
            ) {
                $foundList->add($property);
            }
        }

        return $foundList;
    }

    /**
     * Removes tags by name.
     *
     * @param $propertyName
     *
     * @return PropertyCollection
     */
    public function removeByName($propertyName)
    {
        $removedList = new self();
        $list = $this->getIterator();
        foreach ($list as $index => $property) {
            if ((is_array($propertyName) and in_array($property->getName(), $propertyName))
                or ($property->getName() === $propertyName)
            ) {
                $removedList->add(clone $property);
                $this->remove($index);
            }
        }

        return $removedList;
    }
}
