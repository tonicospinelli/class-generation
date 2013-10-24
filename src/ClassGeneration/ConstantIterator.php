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
 * Constant Iterator ClassGeneration
 * @author Antonio Spinelli <tonicospinelli@gmail.com>
 */
class ConstantIterator extends CollectionIterator
{

    /**
     * Construct the Constant Iterator.
     *
     * @param ConstantCollection $collection
     */
    public function __construct($collection)
    {
        parent::__construct($collection);
    }

    /**
     * Gets the current Constant.
     * @return ConstantInterface
     */
    public function current()
    {
        return parent::current();
    }
}
