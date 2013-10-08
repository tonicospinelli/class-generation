<?php

/**
 * ClassGeneration
 * Copyright (c) 2012 ClassGeneration
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 * @category   ClassGeneration
 * @package    ClassGeneration
 * @copyright  Copyright (c) 2012 ClassGeneration (https://github.com/tonicospinelli/ClassGeneration)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 * @version    ##VERSION##, ##DATE##
 */

namespace ClassGeneration;

use ClassGeneration\DocBlock\TagInterface;
use ClassGeneration\Element\ElementInterface;

/**
 * Interface for Class Elements ClassGeneration
 * @category   ClassGeneration
 * @package    ClassGeneration
 * @copyright  Copyright (c) 2012 ClassGeneration (https://github.com/tonicospinelli/ClassGeneration)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 * @version    ##VERSION##, ##DATE##
 */
interface PhpClassInterface extends ElementInterface
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
     * Adds tag on the Class DocBlock.
     *
     * @param TagInterface $tagArguments
     *
     * @return PhpClassInterface
     */
    public function addCommentTag(TagInterface $tagArguments);

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
     *
     * @param InterfaceCollection $interfacesNames
     *
     * @return PhpClassInterface
     */
    public function setInterfaceCollection(InterfaceCollection $interfacesNames);

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
     * Is a final element?
     * @return boolean
     */
    public function isFinal();

    /**
     * Sets this class is final.
     *
     * @param boolean $isFinal
     *
     * @return PhpClassInterface
     */
    public function setIsFinal($isFinal = true);

    /**
     * Is a abstract element?
     * @return boolean
     */
    public function isAbstract();

    /**
     * Sets this class is abstract.
     *
     * @param boolean $isAbstract
     *
     * @return PhpClassInterface
     */
    public function setIsAbstract($isAbstract = true);
}