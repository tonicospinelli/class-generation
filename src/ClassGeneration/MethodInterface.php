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

use ClassGeneration\DocBlock\TagInterface;
use ClassGeneration\Element\Declarable;
use ClassGeneration\Element\DocumentBlockInterface;
use ClassGeneration\Element\ElementInterface;
use ClassGeneration\Element\StaticInterface;
use ClassGeneration\Element\VisibilityInterface;

/**
 * Method ClassGeneration
 * @author Antonio Spinelli <tonicospinelli@gmail.com>
 */
interface MethodInterface extends ElementInterface, Declarable, VisibilityInterface, StaticInterface, DocumentBlockInterface
{

    /**
     * Gets the method's name
     * @return string
     */
    public function getName();

    /**
     * Sets the method's name.
     * The method name must be camelCase, with first char in lower
     * and other words with first char upper.
     *
     * @param string $name
     *
     * @return MethodInterface
     */
    public function setName($name);

    /**
     * Gets the Arguments Colletion.
     * @return ArgumentCollection
     */
    public function getArgumentCollection();

    /**
     * Add a new Argument Object.
     *
     * @param ArgumentInterface $argument
     *
     * @return MethodInterface
     */
    public function addArgument(ArgumentInterface $argument);

    /**
     * Arguments's list.
     *
     * @param ArgumentCollection $arguments \ClassGeneration\Arguments's array.
     *
     * @return MethodInterface
     */
    public function setArgumentCollection(ArgumentCollection $arguments);

    /**
     * Sets the property's description.
     *
     * @param string $description
     *
     * @return MethodInterface
     */
    public function setDescription($description);

    /**
     * Gets the property's description.
     * @return string
     */
    public function getDescription();

    /**
     * Sets the property's description.
     *
     * @param TagInterface $tag
     *
     * @return MethodInterface
     */
    public function setReturns(TagInterface $tag);

    /**
     * Sets the property's description.
     * @return TagInterface
     */
    public function getReturns();

    /**
     * Method's code
     * @return string
     */
    public function getCode();

    /**
     * Method's code
     *
     * @param string $code
     *
     * @return MethodInterface
     */
    public function setCode($code);
}
