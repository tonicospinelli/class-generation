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
interface Declarable
{

    /**
     * Is a final element?
     * @return boolean
     */
    public function isFinal();

    /**
     * Sets this class is final.
     *
     * @param boolean $isFinal
     *
     * @return ElementInterface
     */
    public function setIsFinal($isFinal = true);

    /**
     * Is a abstract element?
     * @return boolean
     */
    public function isAbstract();

    /**
     * Sets this class is abstract.
     * When set an abstract, isInterface is set false.
     *
     * @param boolean $isAbstract
     *
     * @throws \RuntimeException
     * @return ElementInterface
     */
    public function setIsAbstract($isAbstract = true);

    /**
     * This class is a interface?
     * @return boolean
     */
    public function isInterface();

    /**
     * Sets this class is a interface.
     * When set a interface, abstract is set false.
     *
     * @param boolean $isInterface
     *
     * @throws \RuntimeException
     * @return ElementInterface
     */
    public function setIsInterface($isInterface = true);
}
