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

use ClassGeneration\Collection\CollectionIterator;

/**
 * Argument Iterator ClassGeneration.
 * @author Antonio Spinelli <tonicospinelli@gmail.com>
 */
class ArgumentIterator extends CollectionIterator
{

    /**
     * Construct a Argument Collection Iterator.
     *
     * @param ArgumentCollection $collection
     */
    public function __construct($collection)
    {
        parent::__construct($collection);
    }

    /**
     * Gets the current argument.
     * @return \ClassGeneration\Argument
     */
    public function current()
    {
        return parent::current();
    }
}
