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

/**
 * Property Collection ClassGeneration
 * @author Antonio Spinelli <tonicospinelli@gmail.com>
 */
class CompositionCollection extends ArrayCollection
{
    protected $methods;

    /**
     * Initializes a new ArrayCollection.
     *
     * @param array $elements
     */
    public function __construct(array $elements = array())
    {
        $this->elements = $elements;
        $this->methods = new CompositionMethodCollection();
    }

    /**
     * Adds a new Composition at CompositionCollection.
     *
     * @param CompositionInterface $composition
     *
     * @throws \InvalidArgumentException
     * @return bool
     */
    public function add($composition)
    {
        if (!$composition instanceof CompositionInterface) {
            throw new \InvalidArgumentException(
                'This Constant must be a instance of \ClassGeneration\CompositionInterface'
            );
        }

        return parent::add($composition);
    }

    /**
     * @return CompositionInterface[]
     */
    public function getIterator()
    {
        return parent::getIterator();
    }

    /**
     * @param CompositionMethodInterface $method
     * @return bool
     */
    public function addMethod(CompositionMethodInterface $method)
    {
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
     * @param CompositionInterface $composition
     * @return bool
     */
    public function addComposition(CompositionInterface $composition)
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

        $useTraits = $this->getIterator();
        $tabulationFormatted = $this->current()->getTabulationFormatted();
        $string = 'use ';
        $traitList = array();
        foreach ($useTraits as $useTrait) {
            $traitList[] = $useTrait->toString();
        }

        $compositionMethods = ';' . PHP_EOL;
        if (!$this->getMethods()->isEmpty()) {
            $compositionMethods = ' ' . $this->getMethods()->toString();
        }

        return $tabulationFormatted . $string . implode(', ', $traitList) . $compositionMethods;
    }
}
