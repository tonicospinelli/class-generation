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
 * Method Collection ClassGeneration
 * @author Antonio Spinelli <tonicospinelli@gmail.com>
 */
class MethodCollection extends ArrayCollection
{

    /**
     * Adds a new Method on collection.
     *
     * @param MethodInterface $method
     *
     * @return bool
     *
     * @throws \InvalidArgumentException
     */
    public function add($method)
    {
        if (!$method instanceof MethodInterface) {
            throw new \InvalidArgumentException('This Method must be a instance of \ClassGeneration\MethodInterface');
        }
        if ($method->getName() === null) {
            $method->setName('method' . ($this->count() + 1));
        }

        parent::set($method->getName(), $method);
        return true;
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
     * @param string $methodName
     *
     * @return MethodCollection Returns a collection with removed methods.
     */
    public function removeByName($methodName)
    {
        $removedList = new self();
        $list = $this->getIterator();
        foreach ($list as $index => $method) {
            if ((is_array($methodName) && in_array($method->getName(), $methodName))
                || ($method->getName() === $methodName)
            ) {
                $removedList->add($method);
                $this->remove($index);
            }
        }

        return $removedList;
    }
}
