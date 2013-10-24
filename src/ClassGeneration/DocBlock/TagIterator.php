<?php

/*
 * This file is part of the ClassGeneration package.
 *
 * (c) Antonio Spinelli <tonicospinelli@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ClassGeneration\DocBlock;

use ClassGeneration\Collection\CollectionIterator;

/**
 * @author Antonio Spinelli <tonicospinelli@gmail.com>
 */
class TagIterator extends CollectionIterator
{

    /**
     * Construct the Tag Iterator.
     *
     * @param \ClassGeneration\DocBlock\TagCollection $collection
     */
    public function __construct($collection)
    {
        parent::__construct($collection);
    }

    /**
     * Gets the current Tag.
     * @return \ClassGeneration\DocBlock\Tag
     */
    public function current()
    {
        return parent::current();
    }

    /**
     * Gets the collection.
     * @return \ClassGeneration\DocBlock\TagCollection
     */
    public function getCollection()
    {
        return parent::getCollection();
    }
}
