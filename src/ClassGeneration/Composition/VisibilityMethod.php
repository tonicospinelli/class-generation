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

use ClassGeneration\Visibility;

/**
 * Composition Trait Visibility Method ClassGeneration
 * @author Antonio Spinelli <tonicospinelli@gmail.com>
 */
class VisibilityMethod extends Method implements VisibilityMethodInterface
{

    protected $visibility;

    /**
     * Create a new instance of Composition Method
     * @param string $name
     * @param string $traitName
     * @param string $visibility
     * @return Method
     */
    public static function create($name, $traitName, $visibility)
    {
        $method = new static();
        $method->setName($name);
        $method->setTraitName($traitName);
        $method->setVisibility($visibility);
        return $method;
    }

    /**
     * @inheritdoc
     */
    public function getVisibility()
    {
        return $this->visibility;
    }

    /**
     * @inheritdoc
     * @return VisibilityMethod
     */
    public function setVisibility($visibility)
    {
        Visibility::isValid($visibility);
        $this->visibility = $visibility;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function toString()
    {
        $result = sprintf(
            '%s::%s as %s;',
            $this->getTraitName(),
            $this->getName(),
            $this->getVisibility()
        );
        return $result . PHP_EOL;
    }
}
