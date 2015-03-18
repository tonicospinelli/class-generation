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
use ClassGeneration\Visibility;

/**
 * Composition Trait Alias Method ClassGeneration
 * @author Antonio Spinelli <tonicospinelli@gmail.com>
 */
class AliasMethod extends Method implements AliasMethodInterface
{

    /**
     * @var string
     */
    protected $alias;

    /**
     * @var string
     */
    protected $visibility;

    public function __construct($traitName, $name, $alias, $visibility = null)
    {
        $this->setName($name);
        $this->setTraitName($traitName);
        $this->setAlias($alias);

        if (!empty($visibility)) {
            $this->setVisibility($visibility);
        }
        $this->init();
    }

    /**
     * @inheritdoc
     * @return AliasInterface
     */
    public function setAlias($alias)
    {
        $this->alias = (string)$alias;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * @inheritdoc
     */
    public function hasAlias()
    {
        return !(empty($this->alias) || is_null($this->alias));
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
     * @return AliasMethod
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
            '%s::%s as%s%s;',
            $this->getTraitName(),
            $this->getName(),
            $this->prependWhiteSpace($this->getVisibility()),
            $this->prependWhiteSpace($this->getAlias())
        );
        return $result . PHP_EOL;
    }

    /**
     * Convert visibility to string.
     * @param string $text
     * @return string
     */
    protected function prependWhiteSpace($text)
    {
        if (is_null($text) || empty($text)) {
            return '';
        }
        return ' ' . $text;
    }
}
