<?php

/*
 * This file is part of the ClassGeneration package.
 *
 * (c) Antonio Spinelli <tonicospinelli@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ClassGeneration\Element;

/**
 * Abstract ClassGeneration
 * @author Antonio Spinelli <tonicospinelli@gmail.com>
 */
abstract class ElementAbstract implements ElementInterface, Tabbable
{

    /**
     * Tabulation Identity.
     * @var int
     */
    protected $tabulation = 4;

    /**
     * Parent Class.
     * @var ElementInterface
     */
    protected $parent = null;

    /**
     * @{inheritdoc}
     */
    abstract public function init();

    /**
     * {@inheritdoc}
     */
    abstract public function toString();

    public function __construct($options = array())
    {
        $this->init();
        $this->setOptions($options);
    }

    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * {@inheritdoc}
     */
    public function setParent(ElementInterface $parent)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * {@inheritdoc}
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

    /**
     * {@inheritdoc}
     */
    public function getTabulation()
    {
        return $this->tabulation;
    }

    /**
     * {@inheritdoc}
     */
    public function getTabulationFormatted()
    {
        return str_repeat(' ', $this->getTabulation());
    }

    /**
     * @inheritdoc
     */
    public function setTabulation($tabulation)
    {
        $this->tabulation = (int)$tabulation;

        return $this;
    }
}
