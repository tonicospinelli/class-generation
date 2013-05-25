<?php

/**
 * ClassGeneration
 *
 * Copyright (c) 2012 ClassGeneration
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @category   ClassGeneration
 * @package    ClassGeneration
 * @copyright  Copyright (c) 2012 ClassGeneration (https://github.com/tonicospinelli/ClassGeneration)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 * @version    ##VERSION##, ##DATE##
 */

namespace ClassGeneration\Collection;

/**
 * Collection Iterator
 *
 * @category   ClassGeneration
 * @package    ClassGeneration
 * @copyright  Copyright (c) 2012 ClassGeneration (https://github.com/tonicospinelli/ClassGeneration)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 * @version    ##VERSION##, ##DATE##
 */
class CollectionIterator implements \Iterator, \Countable
{

    /**
     * This is our collection class, defined later in article.
     *
     * @var \ClassGeneration\Collection\ArrayCollection|array
     */
    protected $collection = null;

    /**
     * Current index
     *
     * @var int
     */
    protected $currentIndex = 0;

    /**
     * Keys in collection
     *
     * @var array
     */
    protected $keys = null;

    /**
     * Collection iterator constructor
     *
     * @param \ClassGeneration\Collection\ArrayCollection|array $collection
     */
    public function __construct($collection)
    {
        $this->setCollection($collection);
        $this->keys = $this->getCollection()->getKeys();
    }

    /**
     * Gets the collection.
     *
     * @return ArrayCollection
     */
    public function getCollection()
    {
        return $this->collection;
    }

    /**
     * Sets the collection.
     *
     * @param \ClassGeneration\Collection\ArrayCollection|array $collection
     *
     * @return \ClassGeneration\Collection\CollectionIterator
     * @throws \Exception
     */
    public function setCollection($collection)
    {
        if (!$collection instanceof ArrayCollection AND is_array($collection)) {
            $collection = new ArrayCollection($collection);
        }
        if (!$collection instanceof ArrayCollection) {
            throw new \Exception(
                'The collection is not instance of \ClassGeneration\Collection\ArrayCollection and is not Array'
            );
        }
        $this->currentIndex = 0;
        $this->collection = $collection;

        return $this;
    }

    /**
     * This method returns current item in collection based on currentIndex.
     *
     * @return mixed
     */
    public function current()
    {
        return $this->collection->get($this->key());
    }

    /**
     * Get current key
     *
     * This method returns current items' key in collection based on currentIndex.
     */
    public function key()
    {
        return $this->keys[$this->currentIndex];
    }

    /**
     * Move to next idex
     *
     * This method increases currentIndex by one.
     */
    public function next()
    {
        ++$this->currentIndex;
    }

    /**
     * Rewind
     *
     * This method resets currentIndex by setting it to 0
     */
    public function rewind()
    {
        $this->currentIndex = 0;
    }

    /**
     * Check if current index is valid
     *
     * This method checks if current index is valid by checking the keys array.
     */
    public function valid()
    {
        return array_key_exists($this->currentIndex, $this->keys);
    }

    /**
     * Get number of ocurrences.
     *
     * @return int
     */
    public function count()
    {
        return $this->collection->count();
    }
}
