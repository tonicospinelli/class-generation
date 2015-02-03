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

use ClassGeneration\Element\ElementInterface;
use ClassGeneration\Element\Tabbable;

/**
 * Horizontal Composition Trait ClassGeneration
 * @author Antonio Spinelli <tonicospinelli@gmail.com>
 */
interface CompositionInterface extends ElementInterface, Tabbable
{
    /**
     * Gets the trait's name
     * @return string
     */
    public function getName();

    /**
     * Sets the trait's name.
     *
     * @param string $name
     *
     * @return CompositionInterface
     */
    public function setName($name);
}
