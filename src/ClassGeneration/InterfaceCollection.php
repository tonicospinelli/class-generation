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
 * Interface ClassGeneration
 * @author Antonio Spinelli <tonicospinelli@gmail.com>
 */
class InterfaceCollection extends ArrayCollection
{

    /**
     * Parse the constant string;
     * @return string
     */
    public function toString()
    {
        if ($this->count() < 1) {
            return '';
        }

        return ' implements ' . implode(', ', $this->toArray());
    }
}
