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

namespace ClassGeneration\DocBlock;

use ClassGeneration\Collection\ArrayCollection;

/**
 * Tag Collection ClassGeneration
 *
 * @category   ClassGeneration
 * @package    ClassGeneration
 * @copyright  Copyright (c) 2012 ClassGeneration (https://github.com/tonicospinelli/ClassGeneration)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 * @version    ##VERSION##, ##DATE##
 */
class TagCollection extends ArrayCollection
{

    /**
     * Unique tags for Docblock.
     *
     * @var array
     */
    protected $uniqueTags = array(
        'access', 'category', 'copyright',
        'license', 'name', 'package',
        'return', 'subpackage', 'version'
    );

    /**
     * Adds a new Tag on Dockblock.
     *
     * @param \ClassGeneration\DocBlock\Tag|array $tag
     *
     * @return bool
     */
    public function add($tag)
    {
        if (!$tag instanceof Tag) {
            $tag = new Tag($tag);
        }

        if ($this->isUniqueTag($tag->getName())) {
            $this->removeByName($tag->getName());
        }

        return parent::add($tag);
    }

    /**
     * Check the tag name is unique on collection.
     *
     * @param string $tagName
     *
     * @return bool
     */
    public function isUniqueTag($tagName)
    {
        return in_array($tagName, $this->uniqueTags);
    }

    /**
     * Get Tag Iterator.
     *
     * @return TagIterator
     */
    public function getIterator()
    {
        return new TagIterator($this);
    }

    /**
     * Removes tag by reference.
     *
     * @param int|string|array $reference
     *
     * @return \ClassGeneration\DocBlock\TagCollection
     */
    public function removeByReferece($reference)
    {
        $removedList = new self();
        $list = $this->getIterator();
        foreach ($list as $index => $tag) {
            if ((is_array($reference) AND in_array($tag->getReferenced(), $reference))
                OR ($tag->getReferenced() === $reference)
            ) {
                $removedList->add(clone $tag);
                $this->remove($index);
            }
        }

        return $removedList;
    }

    /**
     * Removes tags by name.
     *
     * @param string|array $tagName
     *
     * @return \ClassGeneration\DocBlock\TagCollection
     */
    public function removeByName($tagName)
    {
        $removedList = new self();
        $list = $this->getIterator();
        foreach ($list as $index => $tag) {
            $name = $tag->getName();
            if ((is_array($tagName) AND in_array($name, $tagName)) OR
                ($name === $tagName)
            ) {
                $this->remove($index);
                $removedList->add($tag);
            }
        }

        return $removedList;
    }

    /**
     * Sort the list by elements.
     *
     * @return void
     */
    public function sortAsc()
    {
        $cmp = function ($a, $b) {
            if ($a->getName() == $b->getName()) {
                return 0;
            }

            return ($a->getName() < $b->getName()) ? -1 : 1;
        };
        usort($this->elements, $cmp);
    }

    /**
     * Sort the list by elements.
     *
     * @return void
     */
    public function sortDesc()
    {
        $cmp = function ($a, $b) {
            if ($a->getName() == $b->getName()) {
                return 0;
            }

            return ($a->getName() > $b->getName()) ? -1 : 1;
        };
        usort($this->elements, $cmp);
    }
}