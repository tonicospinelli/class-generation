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
interface CollectionInterface extends \Countable, \IteratorAggregate, \ArrayAccess
{

    /**
     * Adds an element at the end of the collection.
     *
     * @param mixed $element The element to add.
     *
     * @return boolean Always TRUE.
     */
    public function add($element);

    /**
     * Clears the collection, removing all elements.
     * @return void
     */
    public function clear();

    /**
     * Checks whether an element is contained in the collection.
     * This is an O(n) operation, where n is the size of the collection.
     *
     * @param mixed $element The element to search for.
     *
     * @return boolean TRUE if the collection contains the element, FALSE otherwise.
     */
    public function contains($element);

    /**
     * Checks whether the collection is empty (contains no elements).
     * @return boolean TRUE if the collection is empty, FALSE otherwise.
     */
    public function isEmpty();

    /**
     * Removes the element at the specified index from the collection.
     *
     * @param string|integer $key The kex/index of the element to remove.
     *
     * @return mixed The removed element or null, if the collection did not contain the element.
     */
    public function remove($key);

    /**
     * Removes the specified element from the collection, if it is found.
     *
     * @param mixed $element The element to remove.
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeElement($element);

    /**
     * Checks whether the collection contains an element with the specified key/index.
     *
     * @param mixed $key The key/index to check for.
     *
     * @return boolean TRUE if the collection contains an element with the specified key/index,
     *          FALSE otherwise.
     */
    public function containsKey($key);

    /**
     * Gets the element at the specified key/index.
     *
     * @param mixed $key The key/index of the element to retrieve.
     *
     * @return mixed
     */
    public function get($key);

    /**
     * Gets all keys/indices of the collection.
     * @return array The keys/indices of the collection, in the order of the corresponding
     *          elements in the collection.
     */
    public function getKeys();

    /**
     * Gets all values of the collection.
     * @return array The values of all elements in the collection, in the order they
     *          appear in the collection.
     */
    public function getValues();

    /**
     * Sets an element in the collection at the specified key/index.
     *
     * @param mixed $key   The key/index of the element to set.
     * @param mixed $value The element to set.
     *
     * @return void
     */
    public function set($key, $value);

    /**
     * Gets a native PHP array representation of the collection.
     * @return array
     */
    public function toArray();

    /**
     * Sets the internal iterator to the first element in the collection and
     * returns this element.
     * @return mixed
     */
    public function first();

    /**
     * Sets the internal iterator to the last element in the collection and
     * returns this element.
     * @return mixed
     */
    public function last();

    /**
     * Gets the key/index of the element at the current iterator position.
     */
    public function key();

    /**
     * Gets the element of the collection at the current iterator position.
     * @return mixed
     */
    public function current();

    /**
     * Moves the internal iterator position to the next element.
     */
    public function next();

    /**
     * Gets the index/key of a given element. The comparison of two elements is strict,
     * that means not only the value but also the type must match.
     * For objects this means reference equality.
     *
     * @param mixed $element The element to search for.
     *
     * @return mixed The key/index of the element or FALSE if the element was not found.
     */
    public function indexOf($element);

    /**
     * Extract a slice of $length elements starting at position $offset from the Collection.
     * If $length is null it returns all elements from $offset to the end of the Collection.
     * Keys have to be preserved by this method. Calling this method will only return the
     * selected slice and NOT change the elements contained in the collection slice is called on.
     *
     * @param int $offset
     * @param int $length
     *
     * @return array
     */
    public function slice($offset, $length = null);
}
