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
 * Property Iterator ClassGeneration
 * @author Antonio Spinelli <tonicospinelli@gmail.com>
 */
class PropertyIterator extends CollectionIterator
{

    /**
     * Gets the current Property.
     * @return Property
     */
    public function current()
    {
        return parent::current();
    }
}
