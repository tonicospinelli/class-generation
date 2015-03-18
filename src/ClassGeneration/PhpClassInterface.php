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

use ClassGeneration\Composition\MethodInterface as CompositionMethodInterface;
use ClassGeneration\Element\Declarable;
use ClassGeneration\Element\DocumentBlockInterface;
use ClassGeneration\Element\ElementInterface;

/**
 * Interface for Class Elements ClassGeneration
 * @author Antonio Spinelli <tonicospinelli@gmail.com>
 */
interface PhpClassInterface extends ElementInterface, DocumentBlockInterface, Declarable
{

    /**
     * Gets the classe full name. Include the namespace.
     * @return string
     */
    public function getFullName();

    /**
     * Gets the class name.
     * @return string
     */
    public function getName();

    /**
     * Sets the class name.
     *
     * @param string $name
     *
     * @return PhpClass
     */
    public function setName($name);

    /**
     * Gets the namespace.
     * @return NamespaceInterface
     */
    public function getNamespace();

    /**
     * Sets the namespace.
     *
     * @param NamespaceInterface $namespace Add the namespace path.
     *
     * @return PhpClassInterface
     */
    public function setNamespace(NamespaceInterface $namespace);

    /**
     * Gets Constant Collection.
     * @return ConstantCollection
     */
    public function getConstantCollection();

    /**
     * Sets the constants collection on the Class.
     *
     * @param ConstantCollection $constants
     *
     * @return PhpClassInterface
     */
    public function setConstantCollection(ConstantCollection $constants);

    /**
     * Adds the CONSTANTS on the Class.
     *
     * @param ConstantInterface $const
     *
     * @return PhpClassInterface
     */
    public function addConstant(ConstantInterface $const);

    /**
     * Gets properties collection.
     * @return PropertyCollection
     */
    public function getPropertyCollection();

    /**
     * Gets property by name.
     *
     * @param string $propertyName
     *
     * @return Property
     */
    public function getProperty($propertyName);

    /**
     * Sets properties by collection.
     *
     * @param PropertyCollection $properties
     *
     * @return PhpClassInterface
     */
    public function setPropertyCollection(PropertyCollection $properties);

    /**
     * Adds property in Properties Collection.
     *
     * @param PropertyInterface $property
     *
     * @return PhpClassInterface
     */
    public function addProperty(PropertyInterface $property);

    /**
     * Gets the Methods Collection.
     * @return MethodCollection
     */
    public function getMethodCollection();

    /**
     * Adds Method on Methods Collection.
     *
     * @param MethodInterface $method
     *
     * @return PhpClassInterface
     */
    public function addMethod(MethodInterface $method);

    /**
     * Sets the methods collection.
     *
     * @param MethodCollection $methods
     *
     * @return PhpClassInterface
     */
    public function setMethodCollection(MethodCollection $methods);

    /**
     * Gets the class extends.
     * @return string
     */
    public function getExtends();

    /**
     * Sets the class extended. If this is a Abstract Class,
     * creates automatically abstract methods.
     *
     * @param string $extends
     *
     * @return PhpClassInterface
     */
    public function setExtends($extends);

    /**
     * Gets the interfaces collection.
     * @return InterfaceCollection
     */
    public function getInterfaceCollection();

    /**
     * Adds the new interface.
     *
     * @param string $interfaceName Interface name.
     *
     * @return PhpClassInterface
     */
    public function addInterface($interfaceName);

    /**
     * Sets the interfaces to implement.
     * On replace interface collection all methods will be removed
     * and it adds methods from new interface, if exists.
     *
     * @param InterfaceCollection $interfaceCollection
     *
     * @return PhpClassInterface
     */
    public function setInterfaceCollection(InterfaceCollection $interfaceCollection);

    /**
     * This class is a trait?
     * @return boolean
     */
    public function isTrait();

    /**
     * Sets this class is trait.
     *
     * @param boolean $isTrait
     *
     * @return PhpClassInterface
     */
    public function setIsTrait($isTrait = true);

    /**
     * Sets the class description
     *
     * @param string $description
     *
     * @return PhpClassInterface
     */
    public function setDescription($description);

    /**
     * Gets the collection class use.
     * @return UseCollection
     */
    public function getUseCollection();

    /**
     * Adds the use.
     *
     * @param UseInterface $use
     *
     * @return PhpClassInterface
     */
    public function addUse(UseInterface $use);

    /**
     * Sets the uses.
     *
     * @param UseCollection $uses
     *
     * @return PhpClassInterface
     */
    public function setUseCollection(UseCollection $uses);

    /**
     * Allocates generated class to memory.
     * @return void
     */
    public function evaluate();

    /**
     * Add a new horizontal composition.
     * @param string $traitName
     * @return PhpClassInterface
     */
    public function addComposition($traitName);

    /**
     * Add a new horizontal composition.
     * @param CompositionMethodInterface $compositionMethod
     * @return PhpClassInterface
     */
    public function addCompositionMethod(CompositionMethodInterface $compositionMethod);

    /**
     * @param CompositionCollection $traits
     * @return PhpClassInterface
     */
    public function setCompositionCollection(CompositionCollection $traits);

    /**
     * @return CompositionCollection
     */
    public function getCompositionCollection();
}
