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

/**
 * Composition Trait Conflicting Method ClassGeneration
 * @author Antonio Spinelli <tonicospinelli@gmail.com>
 */
interface ConflictingMethodInterface extends MethodInterface
{
    /**
     * @param string $traitName
     * @return ConflictingMethodInterface
     */
    public function setInsteadOf($traitName);

    /**
     * @return string
     */
    public function getInsteadOf();
}
