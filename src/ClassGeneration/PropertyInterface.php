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
use ClassGeneration\Element\StaticInterface;
use ClassGeneration\Element\VisibilityInterface;

/**
 * Property ClassGeneration
 * @author Antonio Spinelli <tonicospinelli@gmail.com>
 */
interface PropertyInterface extends ElementInterface, VisibilityInterface, StaticInterface, DocumentBlockInterface
{

    /**
     * Gets the property's name
     * @return string
     */
    public function getName();

    /**
     * Sets the property's name.
     *
     * @param string $name
     *
     * @return Property
     */
    public function setName($name);

    /**
     * Gets the property's value.
     * @return mixed
     */
    public function getValue();

    /**
     * Check the property's value.
     * @return boolean
     */
    public function hasValue();

    /**
     * Sets the property's value.
     *
     * @param mixed $value
     *
     * @throws \InvalidArgumentException
     * @return Property
     */
    public function setValue($value);

    /**
     * Gets the property's type.
     * @return string
     */
    public function getType();

    /**
     * Sets the property's type.
     *
     * @param string $type
     *
     * @return Property
     */
    public function setType($type);

    /**
     * Gets a description
     * @return string
     */
    public function getDescription();

    /**
     * Sets a description.
     *
     * @param $description
     *
     * @return Property
     */
    public function setDescription($description);
}
