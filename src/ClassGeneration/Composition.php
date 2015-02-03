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

use ClassGeneration\Element\ElementAbstract;
use ClassGeneration\Element\ElementInterface;

/**
 * Use ClassGeneration
 * @author Antonio Spinelli <tonicospinelli@gmail.com>
 */
class Composition extends ElementAbstract implements CompositionInterface
{

    /**
     * The class name.
     * @var string
     */
    protected $name;

    /**
     * @inheritdoc
     */
    public function init()
    {
    }

    /**
     * @inheritdoc
     * @return Composition
     */
    public function setParent(ElementInterface $parent)
    {
        if (!$parent instanceof PhpClassInterface) {
            throw new \InvalidArgumentException('Only accept instances from ClassGeneration\PhpClassInterface');
        }

        return parent::setParent($parent);
    }

    /**
     * @inheritdoc
     */
    public function setName($name)
    {
        $this->name = (string)$name;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @inheritdoc
     */
    public function toString()
    {
        return $this->getName();
    }
}