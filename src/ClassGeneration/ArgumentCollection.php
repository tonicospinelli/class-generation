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
 * Argument Collection ClassGeneration
 * @author Antonio Spinelli <tonicospinelli@gmail.com>
 */
class ArgumentCollection extends ArrayCollection
{

    /**
     * Add a Argument on collection.<br />
     * The index is a argument name, then will replace
     * if exist a index with the same name.
     *
     * @param ArgumentInterface $argument
     *
     * @throws \InvalidArgumentException
     * @return boolean
     */
    public function add($argument)
    {
        if (!$argument instanceof ArgumentInterface) {
            throw new \InvalidArgumentException(
                'This Argument must be a instance of \ClassGeneration\ArgumentInterface'
            );
        }
        if ($argument->getName() === null) {
            $argument->setName('param' . ($this->count() + 1));
        }

        parent::offsetSet($argument->getName(), $argument);

        return true;
    }

    /**
     * Gets Argument Iterator
     * @return ArgumentIterator|Argument[]
     */
    public function getIterator()
    {
        return new ArgumentIterator($this);
    }

    /**
     * Returns the arguments in string.
     * @return string
     */
    public function toString()
    {
        $arguments = $this->getIterator();
        $params = array();
        $optionals = array();
        foreach ($arguments as $argument) {
            if ($argument->isOptional()) {
                $optionals[] = $argument->toString();
            } else {
                $params[] = $argument->toString();
            }
        }

        return implode(', ', array_merge($params, $optionals));
    }

    /**
     * Removes tags by name.
     *
     * @param string|array|Argument $argumentName
     *
     * @return \ClassGeneration\ArgumentCollection
     */
    public function removeByName($argumentName)
    {
        $removedList = new self();
        $list = $this->getIterator();
        foreach ($list as $index => $argument) {
            if (($argumentName instanceof Argument && $argumentName->getName() != $argument->getName())
                || (is_string($argumentName) && $argument->getName() !== $argumentName)
            ) {
                continue;
            }
            $removedList->add(clone $argument);
            $this->remove($index);
        }

        return $removedList;
    }
}
