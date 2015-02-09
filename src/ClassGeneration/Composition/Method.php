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

use ClassGeneration\Element\ElementAbstract;
use ClassGeneration\Element\ElementInterface;
use ClassGeneration\PhpClass;

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
     * @var string
     */
    protected $traitName;

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
        if (!$parent instanceof PhpClass) {
            throw new \InvalidArgumentException('Only accept instances from ClassGeneration\PhpClass');
        }

        return parent::setParent($parent);
    }

    /**
     * @inheritdoc
     * @return PhpClass
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

    /**
     * @inheritdoc
     */
    public function getTraitName()
    {
        return $this->traitName;
    }

    /**
     * @inheritdoc
     */
    public function setTraitName($traitName)
    {
        $this->traitName = $traitName;
        return $this;
    }
}
