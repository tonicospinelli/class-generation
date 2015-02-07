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
class ConflictingMethod extends Method implements ConflictingMethodInterface
{
    /**
     * @var string
     */
    protected $insteadOf;

    /**
     * Create a new instance of Composition Method
     * @param string $name
     * @param string $traitName
     * @param string $insteadOf
     * @return Method
     */
    public static function create($name, $traitName,$insteadOf)
    {
        $method = new static();
        $method->setName($name);
        $method->setTraitName($traitName);
        $method->setInsteadOf($insteadOf);
        return $method;
    }

    /**
     * @inheritdoc
     * @return ConflictingMethod
     */
    public function setInsteadOf($traitName)
    {
        $this->insteadOf = $traitName;

        return $this;
    }

    /**
     * @inheritdoc
     * @return string
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
            $this->getTraitName(),
            $this->getName(),
            $this->getInsteadOf()
        );
        return $result . PHP_EOL;
    }
}