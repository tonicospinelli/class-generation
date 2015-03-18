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

use ClassGeneration\Element\DocumentBlockInterface;
use ClassGeneration\Element\ElementInterface;

/**
 * Constants ClassGeneration
 * @author Antonio Spinelli <tonicospinelli@gmail.com>
 */
interface ConstantInterface extends ElementInterface, DocumentBlockInterface
{

    /**
     * Gets the constant's name
     * @return string
     */
    public function getName();

    /**
     * Sets Constant Value.
     *
     * @param mixed $value Set the value in simple types: integer, float, string or boolean.
     *
     * @throws \InvalidArgumentException
     * @return Constant
     */
    public function setValue($value);

    /**
     * Sets the constant's name.
     *
     * @param string $name
     *
     * @return \ClassGeneration\Constant
     */
    public function setName($name);

    /**
     * Gets the Constant Value.
     * @return integer|float|string|boolean
     */
    public function getValue();

    /**
     * Sets the constant's description.
     *
     * @param string $description
     *
     * @return Constant
     */
    public function setDescription($description);

    /**
     * Gets the constant's description.
     * @return string
     */
    public function getDescription();
}
