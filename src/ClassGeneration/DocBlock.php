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
namespace ClassGeneration;

use ClassGeneration\DocBlock\TagCollection;
use ClassGeneration\DocBlock\TagCollectionInterface;
use ClassGeneration\DocBlock\TagInterface;
use ClassGeneration\Element\ElementAbstract;

/**
 * DocBlock ClassGeneration
 * @category   ClassGeneration
 * @package    ClassGeneration
 * @copyright  Copyright (c) 2012 ClassGeneration (https://github.com/tonicospinelli/ClassGeneration)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 * @version    ##VERSION##, ##DATE##
 */
class DocBlock extends ElementAbstract implements DocBlockInterface
{

    /**
     * DockBlock description.
     * @var string
     */
    protected $description;

    /**
     * List of allowed tags.
     * @var TagCollectionInterface
     */
    protected $tagCollection;

    /**
     * Initialize.
     */
    public function init()
    {
        $this->tagCollection = new TagCollection();
    }

    /**
     * Gets the description.
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Sets the description
     *
     * @param string $description
     *
     * @return DocBlock
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get list of tags.
     * @return TagCollectionInterface
     */
    public function getTagCollection()
    {
        return $this->tagCollection;
    }

    /**
     * Replace list of tags.
     *
     * @param TagCollectionInterface $tagCollection
     *
     * @return DocBlock
     */
    public function setTagCollection(TagCollectionInterface $tagCollection)
    {
        $this->tagCollection = $tagCollection;

        return $this;
    }

    /**
     * Add a docblock tag.
     *
     * @param TagInterface $tag
     *
     * @return DocBlock
     */
    public function addTag(TagInterface $tag)
    {
        $this->getTagCollection()->add($tag);

        return $this;
    }

    /**
     * Clear all tag list.
     */
    public function clearAllTags()
    {
        $this->tagCollection->clear();
    }

    /**
     * Removes tags by name.
     *
     * @param $tagName
     *
     * @return TagCollection
     */
    public function removeTagsByName($tagName)
    {
        return $this->tagCollection->removeByName($tagName);
    }

    /**
     * Removes tags by reference.
     *
     * @param string $reference
     *
     * @return TagCollection
     */
    public function removeTagsByReference($reference)
    {
        return $this->tagCollection->removeByReferece($reference);
    }

    /**
     * Gets tags by name.
     *
     * @param string $nameTag
     *
     * @return ArrayCollection
     */
    public function getTagsByName($nameTag)
    {
        $foundList = new TagCollection();
        $list = $this->getTagIterator();

        $tag = new Tag(array('name' => $nameTag));
        $nameTag = $tag->getName();

        foreach ($list as $index => $tag) {
            $name = $tag->getName();
            if (is_array($nameTag) AND in_array($name, $nameTag)) {
                $foundList->add($this->getTagCollection()->get($index));
            } elseif ($name === $nameTag) {
                $foundList->add($this->getTagCollection()->get($index));
            }
        }

        return $foundList;
    }

    /**
     * Parse the DockBlock to string.
     * @return string
     */
    public function toString()
    {
        return $this->__toString();
    }

    /**
     * Parse the DockBlock to string.
     * @return string
     */
    public function __toString()
    {
        $tagList = $this->getTagCollection()->getIterator();

        if ($tagList->count() == 0 AND ($this->getDescription() === null OR $this->getDescription() === '')) {
            return PHP_EOL;
        }

        $spaces = $this->getTabulationFormatted();
        $block = PHP_EOL
            . $spaces . '/**' . PHP_EOL
            . $spaces . ' * ' . nl2br($this->getDescription());

        $block = preg_replace('/(\<br \/\>)+[\r\n][\s]*/', '<br />' . PHP_EOL . $spaces . ' * ', $block);
        $block = preg_replace('/\<br \/\>[\r\n][\s]*\* $/', '', $block) . PHP_EOL;

        if ($tagList->count() > 0) {
            $tagList->getCollection()->sortAsc();

            foreach ($tagList as $tag) {
                if ($tag instanceof TagInterface) {
                    $block .= $spaces . ' * ' . str_replace('<br>', '<br>' . $spaces . ' * ', $tag->toString());
                }
            }
        }

        return $block . $spaces . ' */' . PHP_EOL;
    }
}
