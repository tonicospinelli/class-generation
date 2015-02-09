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
use ClassGeneration\Composition\MethodCollection as CompositionMethodCollection;
use ClassGeneration\Composition\MethodInterface as CompositionMethodInterface;
use ClassGeneration\Element\Tabbable;

/**
 * Property Collection ClassGeneration
 * @author Antonio Spinelli <tonicospinelli@gmail.com>
 */
class CompositionCollection extends ArrayCollection implements Tabbable
{
    /**
     * Tabulation Identity.
     * @var int
     */
    protected $tabulation;

    /**
     * @var CompositionMethodCollection
     */
    protected $methods;

    /**
     * Initializes a new ArrayCollection.
     *
     * @param array $elements
     */
    public function __construct(array $elements = array())
    {
        $this->setTabulation(4);
        $this->elements = $elements;
        $this->methods = new CompositionMethodCollection();
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

    /**
     * Adds a new Composition at CompositionCollection.
     *
     * @param string $composition
     *
     * @return bool
     */
    public function add($composition)
    {
        if(!$this->contains($composition)){
            parent::add($composition);
        }
        return true;
    }

    /**
     * @param CompositionMethodInterface $method
     * @return bool
     */
    public function addMethod(CompositionMethodInterface $method)
    {
        $this->addComposition($method->getTraitName());
        return $this->getMethods()->add($method);
    }

    /**
     * @return CompositionMethodCollection
     */
    public function getMethods()
    {
        return $this->methods;
    }

    /**
     * @param CompositionMethodCollection $methods
     * @return CompositionCollection
     */
    public function setMethods(CompositionMethodCollection $methods)
    {
        $this->methods = $methods;
        return $this;
    }

    /**
     * @param string $composition
     * @return bool
     */
    public function addComposition($composition)
    {
        return $this->add($composition);
    }

    /**
     * Parse the Composition Collection to string.
     * @return string
     */
    public function toString()
    {
        if ($this->isEmpty()) {
            return '';
        }

        $traitNames = $this->toArray();
        $tabulationFormatted = $this->getTabulationFormatted();

        $compositionMethods = ';' . PHP_EOL;
        if (!$this->getMethods()->isEmpty()) {
            $compositionMethods = ' ' . $this->getMethods()->toString();
        }

        return $tabulationFormatted . 'use ' . implode(', ', $traitNames) . $compositionMethods;
    }
}
