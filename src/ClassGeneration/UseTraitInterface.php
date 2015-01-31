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

/**
 * Use Trait ClassGeneration
 * @author Antonio Spinelli <tonicospinelli@gmail.com>
 */
interface UseTraitInterface extends ElementInterface
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
     * @return UseTraitInterface
     */
    public function setName($name);
}
