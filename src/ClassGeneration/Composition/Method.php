<?php

/*
 * This file is part of the ClassGeneration package.
 *
 * (c) Antonio Spinelli <tonicospinelli@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ClassGeneration\Composition;

use ClassGeneration\CompositionInterface;
use ClassGeneration\Element\ElementAbstract;
use ClassGeneration\Element\ElementInterface;

/**
 * Composition Method ClassGeneration
 * @author Antonio Spinelli <tonicospinelli@gmail.com>
 */
abstract class Method extends ElementAbstract implements MethodInterface
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
     * @return Method
     */
    public function setParent(ElementInterface $parent)
    {
        if (!$parent instanceof CompositionInterface) {
            throw new \InvalidArgumentException('Only accept instances from ClassGeneration\CompositionInterface');
        }

        return parent::setParent($parent);
    }

    /**
     * @inheritdoc
     * @return CompositionInterface
     */
    public function getParent()
    {
        return parent::getParent();
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
}
