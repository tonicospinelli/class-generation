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
class ConflictingMethod extends Method implements ConflictingMethodInterface
{
    /**
     * @var CompositionInterface
     */
    protected $insteadOf;

    /**
     * @inheritdoc
     * @return ConflictingMethod
     */
    public function setInsteadOf($className)
    {
        $this->insteadOf = $className;

        return $this;
    }

    /**
     * @inheritdoc
     * @return CompositionInterface
     */
    public function getInsteadOf()
    {
        return $this->insteadOf;
    }

    /**
     * @inheritdoc
     */
    public function toString()
    {
        $result = sprintf(
            '%s::%s insteadof %s;',
            $this->getParent()->getName(),
            $this->getName(),
            $this->getInsteadOf()
        );
        return $result . PHP_EOL;
    }
}
