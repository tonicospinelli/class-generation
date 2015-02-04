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

use ClassGeneration\Element\AliasInterface;
use ClassGeneration\Element\ElementInterface;
use ClassGeneration\Element\VisibilityInterface;

/**
 * Composition Trait Alias Method ClassGeneration
 * @author Antonio Spinelli <tonicospinelli@gmail.com>
 */
interface AliasMethodInterface extends ElementInterface, AliasInterface, VisibilityInterface
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
     * @return MethodInterface
     */
    public function setName($name);

}
