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

use ClassGeneration\CompositionInterface;

/**
 * Composition Trait Conflicting Method ClassGeneration
 * @author Antonio Spinelli <tonicospinelli@gmail.com>
 */
interface ConflictingMethodInterface extends MethodInterface
{
    /**
     * @param string $className
     * @return ConflictingMethodInterface
     */
    public function setInsteadOf($className);

    /**
     * @return CompositionInterface
     */
    public function getInsteadOf();
}
