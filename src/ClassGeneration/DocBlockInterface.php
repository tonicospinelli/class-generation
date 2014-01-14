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

use ClassGeneration\DocBlock\TagCollectionInterface;
use ClassGeneration\Element\ElementInterface;

/**
 * DocBlock Interface
 * @author Antonio Spinelli <tonicospinelli@gmail.com>
 */
interface DocBlockInterface extends ElementInterface
{

    /**
     * Get list of tags.
     * @return TagCollectionInterface
     */
    public function getTagCollection();

    /**
     * Replace list of tags.
     *
     * @param TagCollectionInterface $tags ClassGeneration\DocBlock\Tag's array.
     *
     * @return DocBlock
     */
    public function setTagCollection(TagCollectionInterface $tags);

    /**
     * Gets the description.
     * @return string
     */
    public function getDescription();

    /**
     * Sets the description
     *
     * @param string $description
     *
     * @return DocBlock
     */
    public function setDescription($description);
}
