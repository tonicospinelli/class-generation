<?php

/**
 * ClassGeneration
 * Copyright (c) 2012 ClassGeneration
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
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
 * @category   ClassGeneration
 * @package    ClassGeneration
 * @copyright  Copyright (c) 2012 ClassGeneration (https://github.com/tonicospinelli/ClassGeneration)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 * @version    ##VERSION##, ##DATE##
 */
class TagCollection extends ArrayCollection implements TagCollectionInterface
{

    /**
     * Unique tags for Docblock.
     * @var array
     */
    protected $uniqueTags = array(
        'access', 'category', 'copyright',
        'license', 'name', 'package',
        'return', 'subpackage', 'var', 'version',
    );

    /**
     * Adds a new Tag on Dockblock.
     *
     * @param TagInterface $tag
     *
     * @throws \InvalidArgumentException
     * @return bool
     */
    public function add($tag)
    {
        if (!$tag instanceof TagInterface) {
            throw new \InvalidArgumentException('This tag is not allowed');
        }
        if ($this->isUniqueTag($tag->getName())) {
            $this->removeByName($tag->getName());
        }

        return parent::add($tag);
    }

    /**
     * @inheritdoc
     */
    public function isUniqueTag($tagName)
    {
        return in_array($tagName, $this->uniqueTags);
    }

    /**
     * Get Tag Iterator.
     * @return TagIterator|TagInterface[]
     */
    public function getIterator()
    {
        return new TagIterator($this);
    }

    /**
     * @inheritdoc
     * @return TagInterface
     */
    public function current()
    {
        return parent::current();
    }

    /**
     * @inheritdoc
     */
    public function removeByReferece($reference)
    {
        $removedList = new self();
        $list = $this->getIterator();
        foreach ($list as $index => $tag) {
            if ((is_array($reference) and in_array($tag->getReferenced(), $reference))
                or ($tag->getReferenced() === $reference)
            ) {
                $removedList->add(clone $tag);
                $this->remove($index);
            }
        }

        return $removedList;
    }

    /**
     * {@inheritdoc}
     */
    public function removeByName($tagName)
    {
        $removedList = new self();
        $list = $this->getIterator();
        foreach ($list as $index => $tag) {
            $name = $tag->getName();
            if ((is_array($tagName) and in_array($name, $tagName)) or
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
     * @return void
     */
    public function sortAsc()
    {
        $cmp = function (TagInterface $a, TagInterface $b) {
            if ($a->getName() == $b->getName()) {
                return 0;
            }

            return ($a->getName() < $b->getName()) ? -1 : 1;
        };
        usort($this->elements, $cmp);
    }

    /**
     * Sort the list by elements.
     * @return void
     */
    public function sortDesc()
    {
        $cmp = function (TagInterface $a, TagInterface $b) {
            if ($a->getName() == $b->getName()) {
                return 0;
            }

            return ($a->getName() > $b->getName()) ? -1 : 1;
        };
        usort($this->elements, $cmp);
    }
}
