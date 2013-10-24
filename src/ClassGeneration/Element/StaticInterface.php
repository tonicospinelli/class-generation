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
 * Interface for Tabulate Class Elements
 * @author Antonio Spinelli <tonicospinelli@gmail.com>
 */
interface StaticInterface
{

    /**
     * Is a static element?
     * @return bool
     */
    public function isStatic();

    /**
     * Sets this property like static
     *
     * @param bool $isStatic
     *
     * @return mixed
     */
    public function setIsStatic($isStatic = true);
}
