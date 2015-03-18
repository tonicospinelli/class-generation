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

use ClassGeneration\DocBlock;
use ClassGeneration\DocBlockInterface;

/**
 * Interface for Document Class Elements
 * @author Antonio Spinelli <tonicospinelli@gmail.com>
 */
interface DocumentBlockInterface
{

    /**
     * Returns the DocBlock Object.
     * @return DocBlock
     */
    public function getDocBlock();

    /**
     * Sets the DocBlock Object.
     *
     * @param DocBlockInterface $docBlock
     *
     * @return ElementInterface
     */
    public function setDocBlock(DocBlockInterface $docBlock);
}
