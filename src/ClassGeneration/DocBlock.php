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

use ClassGeneration\DocBlock\TagCollection;
use ClassGeneration\DocBlock\TagCollectionInterface;
use ClassGeneration\DocBlock\TagInterface;
use ClassGeneration\Element\ElementAbstract;

/**
 * DocBlock ClassGeneration
 * @author Antonio Spinelli <tonicospinelli@gmail.com>
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
     * {@inheritdoc}
     */
    public function init()
    {
        $this->setTagCollection(new TagCollection());
    }

    /**
     * {@inheritdoc}
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * {@inheritdoc}
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getTagCollection()
    {
        return $this->tagCollection;
    }

    /**
     * {@inheritdoc}
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
     * Removes tags by name.
     *
     * @param string $tagName
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
     * @return TagCollectionInterface
     */
    public function getTagsByName($nameTag)
    {
        $foundList = new TagCollection();
        $list = $this->getTagCollection()->getIterator();

        foreach ($list as $index => $tag) {
            $name = $tag->getName();
            if (is_array($nameTag) and in_array($name, $nameTag)) {
                $foundList->add($this->getTagCollection()->get($index));
            } elseif ($name === $nameTag) {
                $foundList->add($this->getTagCollection()->get($index));
            }
        }

        return $foundList;
    }

    /**
     * @{inheritdoc}
     */
    public function toString()
    {
        if ($this->getTagCollection()->count() == 0
            and ($this->getDescription() === null or $this->getDescription() === '')
        ) {
            return PHP_EOL;
        }

        $spaces = $this->getTabulationFormatted();
        $block = PHP_EOL
            . $spaces . '/**' . PHP_EOL
            . $spaces . ' * ' . $this->getDescription() . PHP_EOL
            . preg_replace('/^ \* /', $spaces . ' * ', $this->getTagCollection()->toString());

        return $block . $spaces . ' */' . PHP_EOL;
    }
}
