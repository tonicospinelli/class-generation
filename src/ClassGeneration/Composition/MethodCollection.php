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

use ClassGeneration\Collection\ArrayCollection;
use ClassGeneration\Element\Tabbable;

/**
 * Method Collection ClassGeneration
 * @author Antonio Spinelli <tonicospinelli@gmail.com>
 */
class MethodCollection extends ArrayCollection implements Tabbable
{
    /**
     * Tabulation Identity.
     * @var int
     */
    protected $tabulation = 4;

    /**
     * @return MethodInterface[]
     */
    public function getIterator()
    {
        return parent::getIterator();
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
     * @param MethodInterface $method
     * @return bool
     */
    public function add($method)
    {
        if (!$method instanceof MethodInterface) {
            throw new \InvalidArgumentException(
                'This Method must be a instance of \ClassGeneration\Composition\MethodInterface'
            );
        }
        parent::set($method->getTraitName() . '.' . $method->getName(), $method);
        return true;
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

        $tabulationFormatted = $this->getTabulationFormatted();

        $string = '{' . PHP_EOL;
        $string .= $this->toStringMethods();
        $string .= $tabulationFormatted . '}';
        return $string . PHP_EOL;
    }

    protected function toStringMethods()
    {
        $useTraits = $this->getIterator();
        $tabulationFormatted = $this->getTabulationFormatted();

        $string = '';
        foreach ($useTraits as $useTrait) {
            $string .= $tabulationFormatted . $tabulationFormatted . $useTrait->toString();
        }

        return $string;
    }
}
