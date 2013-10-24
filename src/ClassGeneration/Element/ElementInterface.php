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
 * Interface for Class Elements ClassGeneration
 * @author Antonio Spinelli <tonicospinelli@gmail.com>
 */
interface ElementInterface
{

    /**
     * Initialize object.
     * @return void
     */
    public function init();

    /**
     * Serialize object to string.
     * @return string
     */
    public function toString();

    /**
     * Gets the owner class.
     * @return ElementInterface
     */
    public function getParent();

    /**
     * Sets the owner class.
     *
     * @param ElementInterface $parent
     *
     * @return ElementInterface
     */
    public function setParent(ElementInterface $parent);

    /**
     * Sets the properties.
     *
     * @param array $options
     *
     * @return ElementInterface
     */
    public function setOptions(array $options);
}
