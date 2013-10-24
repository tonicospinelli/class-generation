<?php

/*
 * This file is part of the ClassGeneration package.
 *
 * (c) Antonio Spinelli <tonicospinelli@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ClassGeneration\Collection;

/**
 * @author Antonio Spinelli <tonicospinelli@gmail.com>
 */
class CollectionIterator implements \Iterator, \Countable
{

    /**
     * This is our collection class, defined later in article.
     * @var CollectionInterface
     */
    protected $collection = null;

    /**
     * Current index
     * @var int
     */
    protected $currentIndex = 0;

    /**
     * Keys in collection
     * @var array
     */
    protected $keys = null;

    /**
     * Collection iterator constructor
     *
     * @param CollectionInterface $collection
     */
    public function __construct(CollectionInterface $collection)
    {
        $this->setCollection($collection);
        $this->keys = $this->getCollection()->getKeys();
    }

    /**
     * Gets the collection.
     * @return CollectionInterface
     */
    public function getCollection()
    {
        return $this->collection;
    }

    /**
     * Sets the collection.
     *
     * @param CollectionInterface $collection
     *
     * @return CollectionIterator
     */
    public function setCollection(CollectionInterface $collection)
    {
        $this->currentIndex = 0;
        $this->collection = $collection;

        return $this;
    }

    /**
     * This method returns current item in collection based on currentIndex.
     * @return mixed
     */
    public function current()
    {
        return $this->collection->get($this->key());
    }

    /**
     * Get current key
     * This method returns current items' key in collection based on currentIndex.
     */
    public function key()
    {
        return $this->keys[$this->currentIndex];
    }

    /**
     * Move to next idex
     * This method increases currentIndex by one.
     */
    public function next()
    {
        ++$this->currentIndex;
    }

    /**
     * Rewind
     * This method resets currentIndex by setting it to 0
     */
    public function rewind()
    {
        $this->currentIndex = 0;
    }

    /**
     * Check if current index is valid
     * This method checks if current index is valid by checking the keys array.
     */
    public function valid()
    {
        return array_key_exists($this->currentIndex, $this->keys);
    }

    /**
     * Get number of ocurrences.
     * @return int
     */
    public function count()
    {
        return $this->collection->count();
    }
}
