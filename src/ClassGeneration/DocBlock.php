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
     * @param string|array $tagName
     *
     * @return TagCollection
     */
    public function removeTagsByName($tagName)
    {
        return $this->getTagCollection()->removeByName($tagName);
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
        return $this->getTagCollection()->removeByReferece($reference);
    }

    /**
     * Gets tags by name.
     *
     * @param string $tagName
     *
     * @return TagCollectionInterface
     */
    public function getTagsByName($tagName)
    {
        $foundList = $this->getTagCollection()->getByName($tagName);

        return $foundList;
    }

    /**
     * @{inheritdoc}
     */
    public function toString()
    {
        if ($this->getTagCollection()->count() == 0
            && ($this->getDescription() === null || $this->getDescription() === '')
        ) {
            return PHP_EOL;
        }

        $spaces = $this->getTabulationFormatted();
        $block = PHP_EOL
            . $spaces . '/**' . PHP_EOL
            . $spaces . ' * ' . $this->getDescription() . PHP_EOL
            . preg_replace('/\s\*\s/i', $spaces . ' * ', $this->getTagCollection()->toString());

        return $block . $spaces . ' */' . PHP_EOL;
    }
}
