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
 * Method Iterator ClassGeneration
 * @author Antonio Spinelli <tonicospinelli@gmail.com>
 */
class MethodIterator extends CollectionIterator
{

    /**
     * Gets the current Method.
     * @return Method
     */
    public function current()
    {
        return parent::current();
    }
}
