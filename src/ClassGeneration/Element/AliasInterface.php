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
 * Alias for Class Elements ClassGeneration
 * @author Antonio Spinelli <tonicospinelli@gmail.com>
 */
interface AliasInterface
{

    /**
     * Sets the alias name.
     *
     * @param string $alias
     *
     * @return AliasInterface
     */
    public function setAlias($alias);

    /**
     * Gets the alias name.
     * @return string
     */
    public function getAlias();

    /**
     * Does it have an alias?
     * @return bool
     */
    public function hasAlias();

}
