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
 * Collection Interface
 *
 * @category   ClassGeneration
 * @package    ClassGeneration
 * @copyright  Copyright (c) 2012 ClassGeneration (https://github.com/tonicospinelli/ClassGeneration)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 * @version    ##VERSION##, ##DATE##
 */
interface ICollection extends \Countable, \IteratorAggregate, \ArrayAccess
{

    /**
     * Adds an element at the end of the collection.
     *
     * @param mixed $element The element to add.
     *
     * @return boolean Always TRUE.
     */
    function add($element);

    /**
     * Clears the collection, removing all elements.
     */
    function clear();

    /**
     * Checks whether an element is contained in the collection.
     * This is an O(n) operation, where n is the size of the collection.
     *
     * @param mixed $element The element to search for.
     *
     * @return boolean TRUE if the collection contains the element, FALSE otherwise.
     */
    function contains($element);

    /**
     * Checks whether the collection is empty (contains no elements).
     *
     * @return boolean TRUE if the collection is empty, FALSE otherwise.
     */
    function isEmpty();

    /**
     * Removes the element at the specified index from the collection.
     *
     * @param string|integer $key The kex/index of the element to remove.
     *
     * @return mixed The removed element or NULL, if the collection did not contain the element.
     */
    function remove($key);

    /**
     * Removes the specified element from the collection, if it is found.
     *
     * @param mixed $element The element to remove.
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    function removeElement($element);

    /**
     * Checks whether the collection contains an element with the specified key/index.
     *
     * @param string|integer $key The key/index to check for.
     *
     * @return boolean TRUE if the collection contains an element with the specified key/index,
     *          FALSE otherwise.
     */
    function containsKey($key);

    /**
     * Gets the element at the specified key/index.
     *
     * @param string|integer $key The key/index of the element to retrieve.
     *
     * @return mixed
     */
    function get($key);

    /**
     * Gets all keys/indices of the collection.
     *
     * @return array The keys/indices of the collection, in the order of the corresponding
     *          elements in the collection.
     */
    function getKeys();

    /**
     * Gets all values of the collection.
     *
     * @return array The values of all elements in the collection, in the order they
     *          appear in the collection.
     */
    function getValues();

    /**
     * Sets an element in the collection at the specified key/index.
     *
     * @param string|integer $key   The key/index of the element to set.
     * @param mixed          $value The element to set.
     */
    function set($key, $value);

    /**
     * Gets a native PHP array representation of the collection.
     *
     * @return array
     */
    function toArray();

    /**
     * Sets the internal iterator to the first element in the collection and
     * returns this element.
     *
     * @return mixed
     */
    function first();

    /**
     * Sets the internal iterator to the last element in the collection and
     * returns this element.
     *
     * @return mixed
     */
    function last();

    /**
     * Gets the key/index of the element at the current iterator position.
     *
     */
    function key();

    /**
     * Gets the element of the collection at the current iterator position.
     *
     */
    function current();

    /**
     * Moves the internal iterator position to the next element.
     *
     */
    function next();

    /**
     * Gets the index/key of a given element. The comparison of two elements is strict,
     * that means not only the value but also the type must match.
     * For objects this means reference equality.
     *
     * @param mixed $element The element to search for.
     *
     * @return mixed The key/index of the element or FALSE if the element was not found.
     */
    function indexOf($element);

    /**
     * Extract a slice of $length elements starting at position $offset from the Collection.
     *
     * If $length is null it returns all elements from $offset to the end of the Collection.
     * Keys have to be preserved by this method. Calling this method will only return the
     * selected slice and NOT change the elements contained in the collection slice is called on.
     *
     * @param int $offset
     * @param int $length
     *
     * @return array
     */
    function slice($offset, $length = null);
}