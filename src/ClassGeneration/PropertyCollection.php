<?php

/*
 * This file is part of the ClassGeneration package.
 *
 * (c) Antonio Spinelli <tonicospinelli@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ClassGeneration;

use ClassGeneration\Collection\ArrayCollection;

/**
 * Property Collection ClassGeneration
 * @author Antonio Spinelli <tonicospinelli@gmail.com>
 */
class PropertyCollection extends ArrayCollection
{

    /**
     * Adds a new Property on the collection.
     *
     * @param PropertyInterface $property
     *
     * @return bool
     * @throws \InvalidArgumentException
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

        parent::set($property->getName(), $property);

        return true;
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
        return new PropertyIterator($this);
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
            if ((is_array($propertyName) && in_array($property->getName(), $propertyName))
                || ($property->getName() === $propertyName)
            ) {
                $foundList->add($property);
            }
        }

        return $foundList;
    }

    /**
     * Removes tags by name.
     *
     * @param string $propertyName
     *
     * @return PropertyCollection
     */
    public function removeByName($propertyName)
    {
        $removedList = new self();
        $list = $this->getIterator();
        foreach ($list as $index => $property) {
            if ((is_array($propertyName) && in_array($property->getName(), $propertyName))
                || ($property->getName() === $propertyName)
            ) {
                $removedList->add(clone $property);
                $this->remove($index);
            }
        }

        return $removedList;
    }
}
