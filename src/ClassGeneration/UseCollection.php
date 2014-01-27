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

use ClassGeneration\Collection\ArrayCollection;
use ClassGeneration\Element\ElementInterface;

/**
 * Use ClassGeneration
 * @author Antonio Spinelli <tonicospinelli@gmail.com>
 */
class UseCollection extends ArrayCollection implements ElementInterface
{

    protected $parent;

    /**
     * Initializes a new ArrayCollection.
     *
     * @param UseClass[] $elements
     */
    public function __construct(array $elements = array())
    {
        parent::__construct($elements);
        $this->init();
    }

    /**
     * Adds a new Use on the collection.
     *
     * @param UseInterface $use
     *
     * @throws \InvalidArgumentException
     * @return bool
     */
    public function add($use)
    {
        if (!$use instanceof UseInterface) {
            throw new \InvalidArgumentException('This Property must be a instance of \ClassGeneration\UseInterface');
        }

        return parent::add($use);
    }

    /**
     * @inheritdoc
     * @return UseIterator|UseClass[]
     */
    public function getIterator()
    {
        return new UseIterator($this);
    }

    /**
     * Parse the Uses to string;
     * @return string
     */
    public function toString()
    {
        $uses = $this->getIterator();
        $string = '';
        foreach ($uses as $use) {
            $string .= $use->toString();
        }

        return $string;
    }

    /**
     * @inheritdoc
     */
    public function init()
    {
    }

    /**
     * @inheritdoc
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @inheritdoc
     */
    public function setParent(ElementInterface $parent)
    {
        if (!$parent instanceof PhpClassInterface) {
            throw new \InvalidArgumentException('Only accept instances from ClassGeneration\PhpClassInterface');
        }
        $this->parent = $parent;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function setOptions(array $options)
    {
        foreach ($options as $prop => $option) {
            $method = 'set' . ucfirst($prop);
            if (method_exists($this, $method)) {
                $this->$method($option);
            }
        }

        return $this;
    }
}
