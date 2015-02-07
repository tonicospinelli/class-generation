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

    public function __construct($traitName, $name, $visibility)
    {
        $this->setTraitName($traitName);
        $this->setName($name);
        $this->setVisibility($visibility);
        $this->init();
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
