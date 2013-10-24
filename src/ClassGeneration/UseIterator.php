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
 * Use Iterator ClassGeneration
 * @author Antonio Spinelli <tonicospinelli@gmail.com>
 */
class UseIterator extends CollectionIterator
{

    /**
     * Construct the Property Iterator.
     *
     * @param PropertyCollection|array $collection
     */
    public function __construct($collection)
    {
        parent::__construct($collection);
    }

    /**
     * Gets the current Property.
     * @return UseInterface
     */
    public function current()
    {
        return parent::current();
    }
}
