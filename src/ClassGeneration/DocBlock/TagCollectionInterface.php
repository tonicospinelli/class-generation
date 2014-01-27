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

use ClassGeneration\Collection\CollectionInterface;
use ClassGeneration\Element\ElementInterface;

/**
 * @author Antonio Spinelli <tonicospinelli@gmail.com>
 */
interface TagCollectionInterface extends CollectionInterface
{

    /**
     * Check the tag name is unique on collection.
     *
     * @param string $tagName
     *
     * @return bool
     */
    public function isUniqueTag($tagName);

    /**
     * Removes tag by reference.
     *
     * @param ElementInterface $reference
     *
     * @return TagCollectionInterface
     */
    public function removeByReferece($reference);

    /**
     * Removes tags by name.
     *
     * @param string|array $tagName
     *
     * @return TagCollectionInterface
     */
    public function removeByName($tagName);

    /**
     * Get Tag Iterator.
     * @return TagIterator|TagInterface[]
     */
    public function getIterator();

    /**
     * @inheritdoc
     * @return TagInterface
     */
    public function current();

    /**
     * Parse the tag collection to string.
     * @return string
     */
    public function toString();

    /**
     * Get all tags with the same name.
     * @param string|array $tagName
     *
     * @return TagCollectionInterface
     */
    public function getByName($tagName);
}
