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
 * Constant Collection ClassGeneration
 * @author Antonio Spinelli <tonicospinelli@gmail.com>
 */
class ConstantCollection extends ArrayCollection
{

    /**
     * Adds a new Constant at ConstantCollection.
     *
     * @param ConstantInterface $constant
     *
     * @throws \InvalidArgumentException
     * @return bool
     */
    public function add($constant)
    {
        if (!$constant instanceof ConstantInterface) {
            throw new \InvalidArgumentException(
                'This Constant must be a instance of \ClassGeneration\ConstantInterface'
            );
        }

        if ($constant->getName() === null) {
            $constant->setName('constant' . ($this->count() + 1));
        }

        return parent::add($constant);
    }

    /**
     * Gets the element of the collection at the current internal iterator position.
     * @return ConstantInterface
     */
    public function current()
    {
        return parent::current();
    }

    /**
     * Gets the Constant Iterator.
     * @return ConstantIterator|Constant[]
     */
    public function getIterator()
    {
        return new ConstantIterator($this);
    }

    /**
     * Parse the Constant Collection to string.
     * @return string
     */
    public function toString()
    {
        $string = '';
        $constants = $this->getIterator();
        foreach ($constants as $constant) {
            $string .= $constant->toString();
        }

        return $string;
    }

    /**
     * Removes tags by name.
     *
     * @param $constantName
     *
     * @return ConstantCollection
     */
    public function removeByName($constantName)
    {
        $removedList = new self();
        $list = $this->getIterator();
        foreach ($list as $index => $constant) {
            $currentName = $constant->getName();
            if ((is_array($constantName) && in_array($currentName, $constantName))
                || ($constant->getName() === $constantName)
            ) {
                $removedList->add(clone $constant);
                $this->remove($index);
            }
        }

        return $removedList;
    }
}
