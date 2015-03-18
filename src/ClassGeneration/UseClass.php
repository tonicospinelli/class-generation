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
class UseClass extends ElementAbstract implements UseInterface
{

    /**
     * The class name.
     * @var string
     */
    protected $className;

    /**
     * The alias for class name.
     * @var string
     */
    protected $alias;

    /**
     * @inheritdoc
     */
    public function init()
    {
    }

    /**
     * @inheritdoc
     * @return PhpClassInterface
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @inheritdoc
     * @return UseInterface
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
    public function setAlias($alias)
    {
        $this->alias = (string)$alias;

        return $this;
    }

    /**
     * Gets the alias name.
     * @return string
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * @inheritdoc
     */
    public function hasAlias()
    {
        $alias = $this->getAlias();

        return (!is_null($alias) && !empty($alias));
    }

    /**
     * @inheritdoc
     */
    public function setClassName($className)
    {
        $this->className = (string)$className;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getClassName()
    {
        return $this->className;
    }

    /**
     * @inheritdoc
     */
    public function toString()
    {

        $implements = 'use '
            . $this->getClassName()
            . ($this->hasAlias() ? ' as ' . $this->getAlias() : '')
            . ';' . PHP_EOL;

        return $implements;
    }
}
