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
interface Tabbable
{

    /**
     * Tabulation class.
     * @return int
     */
    public function getTabulation();

    /**
     * Tabulation fomatted
     * @return string
     */
    public function getTabulationFormatted();

    /**
     * Set tabulation spaces.
     *
     * @param int $tabulation
     *
     * @return ElementAbstract
     */
    public function setTabulation($tabulation);
}
