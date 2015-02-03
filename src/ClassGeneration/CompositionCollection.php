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

/**
 * Property Collection ClassGeneration
 * @author Antonio Spinelli <tonicospinelli@gmail.com>
 */
class CompositionCollection extends ArrayCollection
{
    /**
     * @return CompositionInterface[]
     */
    public function getIterator()
    {
        return parent::getIterator();
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
        $tabulation = '';
        $string = 'use ';
        $traitList = array();
        foreach ($useTraits as $useTrait) {
            $tabulation = $useTrait->getTabulationFormatted();
            $traitList[] = $useTrait->toString();
        }

        return $tabulation . $string . implode(', ', $traitList) . ';' . PHP_EOL;
    }
}
