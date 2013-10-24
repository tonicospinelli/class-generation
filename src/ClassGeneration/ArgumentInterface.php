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
 * Argument Interface
 * @author Antonio Spinelli <tonicospinelli@gmail.com>
 */
interface ArgumentInterface extends ElementInterface
{

    /**
     * Gets the property's name
     * @return string
     */
    public function getName();

    /**
     * Gets the property's name
     * @return string
     */
    public function getNameFormatted();

    /**
     * Sets the property's name.
     *
     * @param string $name
     *
     * @return \ClassGeneration\Argument
     */
    public function setName($name);

    /**
     * Gets the value.
     * @return string
     */
    public function getValue();

    /**
     * Sets the value.
     *
     * @param string $value
     *
     * @return \ClassGeneration\ArgumentInterface
     */
    public function setValue($value);

    /**
     * Check if this argument is optional.
     * @return bool
     */
    public function isOptional();

    /**
     * Sets the argument is optional.
     *
     * @param bool $isOptional
     *
     * @return \ClassGeneration\ArgumentInterface
     */
    public function setIsOptional($isOptional = true);

    /**
     * Gets the argument type.
     * @return string
     */
    public function getType();

    /**
     * Check if this argument has type and is a primitive type.
     * @return boolean
     */
    public function hasType();

    /**
     * Sets a argument type.
     *
     * @param string $type
     *
     * @return \ClassGeneration\Argument
     */
    public function setType($type);

    /**
     * Get the argument description.
     * @return string
     */
    public function getDescription();

    /**
     * Sets the argument description.
     *
     * @param string $description
     *
     * @return \ClassGeneration\ArgumentInterface
     */
    public function setDescription($description);
}
