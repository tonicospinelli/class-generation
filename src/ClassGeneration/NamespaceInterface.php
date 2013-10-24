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
 * Namespace ClassGeneration
 * @author Antonio Spinelli <tonicospinelli@gmail.com>
 */
interface NamespaceInterface extends ElementInterface
{

    /**
     * Gets the path.
     * @return string
     */
    public function getPath();

    /**
     * Sets the Path.
     *
     * @param string $path
     *
     * @return NamespaceInterface
     */
    public function setPath($path);

    /**
     * Sets the namespace's description.
     *
     * @param string $description
     *
     * @return NamespaceInterface
     */
    public function setDescription($description);

    /**
     * Gets the namespace's description.
     * @return string
     */
    public function getDescription();
}
