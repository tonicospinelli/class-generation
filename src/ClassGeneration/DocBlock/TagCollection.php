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

use ClassGeneration\Collection\ArrayCollection;

/**
 * @author Antonio Spinelli <tonicospinelli@gmail.com>
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
            if ((is_array($reference) && in_array($tag->getReferenced(), $reference))
                || ($tag->getReferenced() === $reference)
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
            if ((is_array($tagName) && in_array($name, $tagName)) ||
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

    public function toString()
    {
        if ($this->count() < 1) {
            return '';
        }
        $tagIterator = $this->getIterator();
        $string = '';
        foreach ($tagIterator as $tag) {
            $string .= ' * ' . $tag->toString();
        }

        return $string;
    }

    /**
     * @inheritdoc
     */
    public function getByName($tagName)
    {
        $found = new self;
        $list = $this->getIterator();

        foreach ($list as $index => $tag) {
            $name = $tag->getName();
            if (is_array($tagName) && in_array($name, $tagName)) {
                $found->add($this->get($index));
            } elseif ($name === $tagName) {
                $found->add($this->get($index));
            }
        }

        return $found;
    }
}
