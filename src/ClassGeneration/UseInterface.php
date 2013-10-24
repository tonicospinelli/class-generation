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
 * Use ClassGeneration
 * @author Antonio Spinelli <tonicospinelli@gmail.com>
 */
interface UseInterface extends ElementInterface
{

    /**
     * Sets the alias name.
     *
     * @param string $alias
     *
     * @return UseInterface
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


    /**
     * Sets the class name.
     *
     * @param string $className
     *
     * @return UseInterface
     */
    public function setClassName($className);

    /**
     * Gets the class name.
     * @return string
     */
    public function getClassName();
}
