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
use ClassGeneration\Element\ElementAbstract;

/**
 * Class to create a PhpClass Object
 * @author Antonio Spinelli <tonicospinelli@gmail.com>
 */
class PhpClass extends ElementAbstract implements PhpClassInterface
{

    /**
     * Sets like a trait.
     * @var boolean
     */
    protected $isTrait = false;

    /**
     * Sets like an interface.
     * @var boolean
     */
    protected $isInterface = false;

    /**
     * Set like a final.
     * @var bool
     */
    protected $isFinal = false;

    /**
     * Set like an abstract.
     * @var bool
     */
    protected $isAbstract = false;

    /**
     * Documentation Block
     * @var DocBlockInterface
     */
    protected $docBlock;

    /**
     * Class name
     * @var string
     */
    protected $name;

    /**
     * Class namespace
     * @var NamespaceInterface
     */
    protected $namespace;

    /**
     * Class Use Collection
     * @var UseCollection
     */
    protected $useCollection;

    /**
     * Class constants
     * @var ConstantCollection
     */
    protected $constants;

    /**
     * Class properties
     * @var PropertyCollection
     */
    protected $properties;

    /**
     * Class methods
     * @var MethodCollection
     */
    protected $methods;

    /**
     * Extends from.
     * @var string
     */
    protected $extends;

    /**
     * Implements the interfaces.
     * @var InterfaceCollection
     */
    protected $interfaces;

    /**
     * @var CompositionCollection
     */
    protected $compositionCollection;

    /**
     * Force on add method on class docblock.
     * @var boolean
     */
    public $forceMethodInDocBlock = false;

    /**
     * Force on add property on class docblock.
     * @var boolean
     */
    public $forcePropertyInDocBlock = false;

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        $this->setTabulation(0);
        $this->setDocBlock(new DocBlock());
        $this->setMethodCollection(new MethodCollection());
        $this->setPropertyCollection(new PropertyCollection());
        $this->setConstantCollection(new ConstantCollection());
        $this->setInterfaceCollection(new InterfaceCollection());
        $this->setNamespace(new NamespaceClass());
        $this->setUseCollection(new UseCollection());
        $this->setCompositionCollection(new CompositionCollection());
    }

    /**
     * {@inheritdoc}
     */
    public function getDocBlock()
    {
        return $this->docBlock;
    }

    /**
     * {@inheritdoc}
     */
    public function setDocBlock(DocBlockInterface $docBlock)
    {
        $this->docBlock = $docBlock;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getFullName()
    {
        return $this->getNamespace()->getPath() . '\\' . $this->getName();
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @inheritdoc
     */
    public function setName($name)
    {
        $replaceTo = strpos($name, '_') !== false ? '_' : '';
        $this->name = str_replace(' ', $replaceTo, ucwords(strtr($name, '_-', '  ')));

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getNamespace()
    {
        return $this->namespace;
    }

    /**
     * @inheritdoc
     */
    public function setNamespace(NamespaceInterface $namespace)
    {
        $namespace->setParent($this);
        $this->namespace = $namespace;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getConstantCollection()
    {
        return $this->constants;
    }

    /**
     * @inheritdoc
     */
    public function setConstantCollection(ConstantCollection $constants)
    {
        $this->constants = $constants;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function addConstant(ConstantInterface $const)
    {
        $const->setParent($this);
        $this->getConstantCollection()->add($const);

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getPropertyCollection()
    {
        return $this->properties;
    }

    /**
     * @inheritdoc
     */
    public function getProperty($propertyName)
    {
        return $this->properties->getByName($propertyName);
    }

    /**
     * @inheritdoc
     */
    public function setPropertyCollection(PropertyCollection $properties)
    {
        $this->properties = $properties;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function addProperty(PropertyInterface $property)
    {
        $property->setParent($this);
        $this->getPropertyCollection()->add($property);

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getMethodCollection()
    {
        return $this->methods;
    }

    /**
     * @inheritdoc
     */
    public function addMethod(MethodInterface $method)
    {
        $method->setParent($this);
        $this->getMethodCollection()->add($method);

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function setMethodCollection(MethodCollection $methods)
    {
        $this->methods = $methods;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getExtends()
    {
        return $this->extends;
    }

    /**
     * @inheritdoc
     */
    public function setExtends($extends)
    {
        $this->extends = $extends;

        $this->createMethodsFromAbstractClass($extends);

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getInterfaceCollection()
    {
        return $this->interfaces;
    }

    /**
     * @inheritdoc
     */
    public function addInterface($interfaceName)
    {
        $this->interfaces->add($interfaceName);
        $this->createMethodsFromInterface($interfaceName);

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function setInterfaceCollection(InterfaceCollection $interfacesNames)
    {
        $this->interfaces = $interfacesNames;

        return $this;
    }

    /**
     * Creates methods from Interface.
     *
     * @param string $interfaceName
     */
    protected function createMethodsFromInterface($interfaceName)
    {
        if (!interface_exists($interfaceName)) {
            return;
        }

        $refInterface = new \ReflectionClass($interfaceName);
        $methodsReflected = $refInterface->getMethods();
        foreach ($methodsReflected as $methodReflected) {
            if ($this->getMethodCollection()->exists($methodReflected->getName())) {
                continue;
            }
            $method = Method::createFromReflection($methodReflected);
            $this->addMethod($method);
        }
    }


    /**
     * Creates methods from Abstract.
     *
     * @param string $abstractClass
     *
     * @return void
     */
    protected function createMethodsFromAbstractClass($abstractClass)
    {
        if (!class_exists($abstractClass)) {
            return;
        }

        $refExtends = new \ReflectionClass($abstractClass);
        $methodsRef = $refExtends->getMethods();
        foreach ($methodsRef as $methodRef) {
            if (!$methodRef->isAbstract() || $this->getMethodCollection()->exists($methodRef->getName())) {
                continue;
            }

            $method = Method::createFromReflection($methodRef);
            $this->addMethod($method);
        }
    }

    /**
     * @inheritdoc
     */
    public function isTrait()
    {
        return $this->isTrait;
    }

    /**
     * @inheritdoc
     */
    public function setIsTrait($isTrait = true)
    {
        $this->isTrait = (bool)$isTrait;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function isInterface()
    {
        return $this->isInterface;
    }

    /**
     * @inheritdoc
     */
    public function setIsInterface($isInterface = true)
    {
        if ($this->isAbstract()) {
            throw new \RuntimeException('This method is an abstract and it not be an interface too.');
        }

        $this->isInterface = (bool)$isInterface;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function setDescription($description)
    {
        $this->docBlock->setDescription($description);

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getUseCollection()
    {
        return $this->useCollection;
    }

    /**
     * @inheritdoc
     */
    public function addUse(UseInterface $use)
    {
        $this->useCollection->add($use);

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function setUseCollection(UseCollection $uses)
    {
        $this->useCollection = $uses;

        return $this;
    }

    /**
     * Create all getters and setters from Property Collection.
     * @return void
     */
    public function generateGettersAndSettersFromProperties()
    {
        $propertyIterator = $this->getPropertyCollection()->getIterator();
        foreach ($propertyIterator as $property) {
            $this->getMethodCollection()->add(Method::createGetterFromProperty($property));
            $this->getMethodCollection()->add(Method::createSetterFromProperty($property));
        }
    }

    /**
     * @inheritdoc
     */
    public function toString()
    {
        $extends = '';
        if ($this->getExtends()) {
            $extends = ' extends ' . $this->getExtends();
        }
        $string = '<?php' . PHP_EOL
            . $this->getNamespace()->toString()
            . $this->getUseCollection()->toString()
            . $this->getDocBlock()->setTabulation($this->getTabulation())->toString()
            . $this->toStringType()
            . $this->getName()
            . $extends
            . $this->getInterfaceCollection()->toString()
            . PHP_EOL
            . '{'
            . PHP_EOL
            . $this->getCompositionCollection()->toString()
            . $this->getConstantCollection()->toString()
            . $this->getPropertyCollection()->toString()
            . $this->getMethodCollection()->toString()
            . '}' . PHP_EOL;

        return $string;
    }

    /**
     * @inheritdoc
     */
    public function evaluate()
    {
        $classString = substr($this->toString(), 7);
        eval($classString);
    }

    /**
     * {@inheritdoc}
     */
    public function isFinal()
    {
        return $this->isFinal;
    }

    /**
     * {@inheritdoc}
     * @return PhpClass
     */
    public function setIsFinal($isFinal = true)
    {
        $this->isFinal = (bool)$isFinal;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function isAbstract()
    {
        return $this->isAbstract;
    }

    /**
     * {@inheritdoc}
     */
    public function setIsAbstract($isAbstract = true)
    {
        if ($this->isInterface()) {
            throw new \RuntimeException('This class is an interface and it not be an abstract too.');
        }

        $this->isAbstract = (bool)$isAbstract;

        return $this;
    }

    /**
     * Get string based on type set.
     * @return string
     */
    protected function toStringType()
    {
        $type = 'class ';

        switch (true) {
            case $this->isInterface():
                $type = 'interface ';
                break;
            case $this->isAbstract():
                $type = 'abstract class ';
                break;
            case $this->isFinal():
                $type = 'final class ';
                break;
            case $this->isTrait():
                $type = 'trait ';
        }

        return $type;
    }

    /**
     * @inheritdoc
     */
    public function addComposition($traitName)
    {
        $this->getCompositionCollection()->add($traitName);

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function addCompositionMethod(CompositionMethodInterface $compositionMethod)
    {
        $compositionMethod->setParent($this);
        $this->getCompositionCollection()->addMethod($compositionMethod);
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function setCompositionCollection(CompositionCollection $traits)
    {
        $this->compositionCollection = $traits;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getCompositionCollection()
    {
        return $this->compositionCollection;
    }
}
