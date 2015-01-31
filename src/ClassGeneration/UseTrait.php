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
class UseTrait extends ElementAbstract implements UseTraitInterface
{

    /**
     * The class name.
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $alias;

    /**
     * @var string
     */
    protected $visibility;

    /**
     * @inheritdoc
     */
    public function init()
    {
    }

    /**
     * @inheritdoc
     * @return UseTrait
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

        return (!is_null($alias) and !empty($alias));
    }

    /**
     * @inheritdoc
     */
    public function getVisibility()
    {
        return $this->visibility;
    }

    /**
     * @inheritdoc
     * @return UseTrait
     */
    public function setVisibility($visibility)
    {
        Visibility::isValid($visibility);
        $this->visibility = $visibility;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function toString()
    {
        return $this->getName();
    }
}
