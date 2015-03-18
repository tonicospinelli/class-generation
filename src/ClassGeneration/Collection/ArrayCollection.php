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
class ArrayCollection implements CollectionInterface
{

    /**
     * An array containing the entries of this collection.
     * @var array
     */
    protected $elements;

    /**
     * Initializes a new ArrayCollection.
     *
     * @param array $elements
     */
    public function __construct(array $elements = array())
    {
        $this->elements = $elements;
    }

    /**
     * Gets the PHP array representation of this collection.
     * @return array The PHP array representation of this collection.
     */
    public function toArray()
    {
        return $this->elements;
    }

    /**
     * {@inheritdoc}
     */
    public function first()
    {
        return reset($this->elements);
    }

    /**
     * {@inheritdoc}
     */
    public function last()
    {
        return end($this->elements);
    }

    /**
     * {@inheritdoc}
     */
    public function key()
    {
        return key($this->elements);
    }

    /**
     * {@inheritdoc}
     */
    public function next()
    {
        return next($this->elements);
    }

    /**
     * {@inheritdoc}
     */
    public function current()
    {
        return current($this->elements);
    }

    /**
     * {@inheritdoc}
     */
    public function remove($key)
    {
        if (isset($this->elements[$key])) {
            $removed = $this->elements[$key];
            unset($this->elements[$key]);

            return $removed;
        }

        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function removeElement($element)
    {
        $key = array_search($element, $this->elements, true);

        if ($key !== false) {
            unset($this->elements[$key]);

            return true;
        }

        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function offsetExists($offset)
    {
        return $this->containsKey($offset);
    }

    /**
     * {@inheritdoc}
     */
    public function offsetGet($offset)
    {
        return $this->get($offset);
    }

    /**
     * {@inheritdoc}
     */
    public function offsetSet($offset, $value)
    {
        if (!isset($offset)) {
            return $this->add($value);
        }

        return $this->set($offset, $value);
    }

    /**
     * {@inheritdoc}
     */
    public function offsetUnset($offset)
    {
        return $this->remove($offset);
    }

    /**
     * {@inheritdoc}
     */
    public function containsKey($key)
    {
        return isset($this->elements[$key]);
    }

    /**
     * {@inheritdoc}
     */
    public function contains($element)
    {
        foreach ($this->elements as $collectionElement) {
            if ($element === $collectionElement) {
                return true;
            }
        }

        return false;
    }

    /**
     * {@inheritdoc}
     * @param string $findElement
     */
    public function exists($findKey = null, $findElement = null)
    {
        if (!is_null($findKey) && is_null($findElement)) {
            return $this->containsKey($findKey);
        } elseif (is_null($findKey) && !is_null($findElement)) {
            return $this->contains($findElement);
        } else {
            return $this->containsKey($findKey) && $this->contains($findElement);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function indexOf($element)
    {
        return array_search($element, $this->elements, true);
    }

    /**
     * {@inheritdoc}
     */
    public function get($key)
    {
        if (isset($this->elements[$key])) {
            return $this->elements[$key];
        }

        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function getKeys()
    {
        return array_keys($this->elements);
    }

    /**
     * {@inheritdoc}
     */
    public function getValues()
    {
        return array_values($this->elements);
    }

    /**
     * {@inheritdoc}
     */
    public function count()
    {
        return count($this->elements);
    }

    /**
     * {@inheritdoc}
     */
    public function set($key, $value)
    {
        $this->elements[$key] = $value;
    }

    /**
     * {@inheritdoc}
     */
    public function add($value)
    {
        $this->elements[] = $value;

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function isEmpty()
    {
        return !$this->elements;
    }

    /**
     * {@inheritdoc}
     */
    public function getIterator()
    {
        return new CollectionIterator($this);
    }

    /**
     * {@inheritdoc}
     */
    public function clear()
    {
        $this->elements = array();
    }

    /**
     * {@inheritdoc}
     */
    public function slice($offset, $length = null)
    {
        return array_slice($this->elements, $offset, $length, true);
    }

    /**
     * Sorting by values using a user-defined comparison function.
     *
     * @param \Closure $callable
     *
     * @return void
     */
    public function sort(\Closure $callable)
    {
        usort($this->elements, $callable);
    }

    /**
     * Sort the list by elements.
     * @return void
     */
    public function sortAsc()
    {
        $this->sort(function ($a, $b) {
            if ($a === $b) {
                return 0;
            }

            return ($a < $b) ? -1 : 1;
        });
    }

    /**
     * Sort the list by elements.
     * @return void
     */
    public function sortDesc()
    {
        $this->sort(function ($a, $b) {
            if ($a === $b) {
                return 0;
            }

            return ($a > $b) ? -1 : 1;
        });
    }
}
