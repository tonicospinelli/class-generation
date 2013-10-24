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
interface VisibilityInterface
{

    /**
     * Gets the element visibility.
     * @return string
     */
    public function getVisibility();

    /**
     * Sets the element visibility.
     *
     * @param string $visibility Use the constants in the Visibility.
     *
     * @throws \InvalidArgumentException If the visibility is not found.
     * @return mixed
     */
    public function setVisibility($visibility);
}
