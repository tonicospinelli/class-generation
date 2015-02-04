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

use ClassGeneration\Element\ElementInterface;

/**
 * Composition Trait Method ClassGeneration
 * @author Antonio Spinelli <tonicospinelli@gmail.com>
 */
interface MethodInterface extends ElementInterface
{
    /**
     * Gets the trait method's name
     * @return string
     */
    public function getName();

    /**
     * Sets the trait method's name.
     *
     * @param string $name
     *
     * @return MethodInterface
     */
    public function setName($name);

    /**
     * Sets the trait's name.
     * @param string $name
     * @return MethodInterface
     */
    public function setTraitName($name);

    /**
     * Get trait's name.
     * @return string
     */
    public function getTraitName();
}
