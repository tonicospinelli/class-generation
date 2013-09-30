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

use ClassGeneration\DocBlock\Tag;
use ClassGeneration\Element\Declarable;
use ClassGeneration\Element\Documentary;
use ClassGeneration\Element\ElementAbstract;

/**
 * @category   ClassGeneration
 * @package    ClassGeneration
 * @copyright  Copyright (c) 2012 ClassGeneration (https://github.com/tonicospinelli/ClassGeneration)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 * @version    ##VERSION##, ##DATE##
 */
class Builder extends ElementAbstract implements ClassInterface, Documentary, Declarable
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
     * @var Namespacing
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
        $this->docBlock = new DocBlock();
        $this->methods = new MethodCollection();
        $this->properties = new PropertyCollection();
        $this->constants = new ConstantCollection();
        $this->interfaces = new InterfaceCollection();
        $this->namespace = new Namespacing();
        $this->useCollection = new UseCollection();
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
     * Gets the classe full name. Include the namespace.
     * @return string
     */
    public function getFullName()
    {
        return $this->getNamespace()->getPath() . '\\' . $this->getName();
    }

    /**
     * Gets the class name.
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets the class name.
     *
     * @param string $name
     *
     * @return Builder
     */
    public function setName($name)
    {
        $replaceTo = strpos($name, '_') !== false ? '_' : '';
        $this->name = str_replace(' ', $replaceTo, ucwords(strtr($name, '_-', '  ')));
        $this->addCommentTag(
            new Tag(
                array(
                    'name'        => Tag::TAG_NAME,
                    'description' => $this->name
                )
            )
        );

        return $this;
    }

    /**
     * Gets the namespace.
     * @return Namespacing
     */
    public function getNamespace()
    {
        return $this->namespace;
    }

    /**
     * Sets the namespace.
     *
     * @param Namespacing|string $namespace Add the namespace path.
     *
     * @return Builder
     */
    public function setNamespace($namespace)
    {
        if (!$namespace instanceof Namespacing) {
            $namespace = new Namespacing(array('path' => $namespace));
        }
        $this->namespace = $namespace;

        return $this;
    }

    /**
     * Gets Constant Collection.
     * @return ConstantCollection
     */
    public function getConstants()
    {
        return $this->constants;
    }

    /**
     * Sets the constants collection on the Class.
     *
     * @param ConstantCollection|array $constants
     *
     * @return Builder
     */
    public function setConstants($constants)
    {
        $this->constants->clear();

        if (!$constants instanceof ConstantCollection) {
            $constants = new ConstantCollection($constants);
        }

        foreach ($constants as $constant) {
            $this->addConstant($constant);
        }

        return $this;
    }

    /**
     * Adds the CONSTANTS on the Class.
     *
     * @param Constant $const
     *
     * @return Builder
     */
    public function addConstant(Constant $const)
    {
        $const->setParent($this);
        $this->constants->add($const);

        return $this;
    }

    /**
     * Gets properties collection.
     * @return PropertyCollection
     */
    public function getProperties()
    {
        return $this->properties;
    }

    /**
     * Gets property by name.
     *
     * @param string $propertyName
     *
     * @return PropertyCollection
     */
    public function getProperty($propertyName)
    {
        return $this->properties->getByName($propertyName);
    }

    /**
     * Sets properties by collection.
     *
     * @param PropertyCollection|array $properties
     * @param boolean                  $generateMethods If TRUE generate GET and SET methods from this property.
     *
     * @return Builder
     */
    public function setProperties($properties, $generateMethods = false)
    {
        $this->properties->clear();
        $this->getDocBlock()->removeTagsByName('property');

        if (!$properties instanceof PropertyCollection) {
            $properties = new PropertyCollection($properties);
        }
        foreach ($properties as $property) {
            $this->addProperty($property, $generateMethods);
        }

        return $this;
    }

    /**
     * Adds property in Properties Collection.
     *
     * @param Property $prop
     * @param boolean  $generateMethods If TRUE generate GET and SET methods from this property.
     *
     * @return Builder
     */
    public function addProperty(Property $prop, $generateMethods = false)
    {
        $prop->setParent($this);
        $this->properties->add($prop);
        if ($this->forcePropertyInDocBlock) {
            $this->addCommentTag(
                new Tag(
                    array(
                        'name'        => Tag::TAG_PROPERTY,
                        'type'        => $prop->getType(),
                        'variable'    => $prop->getName(),
                        'description' => $prop->getDescription(),
                        'referenced'  => $this->properties->last()
                    )
                )
            );
        }
        if ($generateMethods) {
            $this->addMethod(
                new Method(
                    array(
                        'name' => 'get_' . $prop->getName(),
                        'code' => 'return $this->' . $prop->getName() . ';'
                    )
                )
            );
            $argument = new Argument(array('name' => $prop->getName(), 'type' => $prop->getType()));
            $code = '$this->' . $prop->getName() . ' = ' . $argument->getName(true) . ';'
                . PHP_EOL . 'return $this;';
            $this->addMethod(
                new Method(
                    array(
                        'name'   => 'set_' . $prop->getName(),
                        'params' => array($argument),
                        'code'   => $code
                    )
                )
            );
        }

        return $this;
    }

    /**
     * Adds tag on the Class DocBlock.
     *
     * @param Tag|array $tagArguments
     *
     * @return Builder
     */
    public function addCommentTag($tagArguments)
    {
        $this->getDocBlock()->addTag($tagArguments);

        return $this;
    }

    /**
     * Gets the Methods Collection.
     * @return MethodCollection
     */
    public function getMethods()
    {
        return $this->methods;
    }

    /**
     * Adds Method on Methods Collection.
     *
     * @param Method $method
     *
     * @return Builder
     */
    public function addMethod(Method $method)
    {
        $method->setParent($this);
        $this->methods->add($method);
        if ($this->forceMethodInDocBlock) {
            $type = ($method->getReturns() instanceof Tag ?
                $method->getReturns()->getType() : null);

            $this->addCommentTag(
                new Tag(
                    array(
                        'name'        => Tag::TAG_METHOD,
                        'type'        => $type,
                        'variable'    => $method->getName(),
                        'description' => $method->getDescription(),
                        'referenced'  => $this->methods->last()
                    )
                )
            );
        }

        return $this;
    }

    /**
     * Sets the methods collection.
     *
     * @param MethodCollection $methods
     *
     * @return Builder
     */
    public function setMethods($methods)
    {
        $this->methods->clear();
        $this->getDocBlock()->removeTagsByName('method');

        if (!$methods instanceof MethodCollection) {
            $methods = new MethodCollection($methods);
        }
        foreach ($methods as $method) {
            $this->addMethod($method);
        }

        return $this;
    }

    /**
     * Gets the class extends.
     * @return string
     */
    public function getExtends()
    {
        return $this->extends;
    }

    /**
     * Sets the class extended. If this is a Abstract Class,
     * creates automatically abstract methods.
     *
     * @param string $extends
     *
     * @return Builder
     */
    public function setExtends($extends)
    {
        $this->extends = $extends;
        if (class_exists($extends)) {
            $refExtends = new \ReflectionClass($extends);
            $methods = $refExtends->getMethods();
            foreach ($methods as $method) {
                if ($method->isAbstract()) {
                    $this->addMethod(new Method(array('name' => $method->getName())));
                }
            }
        }

        return $this;
    }

    /**
     * Gets the interfaces collection.
     * @return InterfaceCollection
     */
    public function getInterfaceCollection()
    {
        return $this->interfaces;
    }

    /**
     * Adds the new interface.
     *
     * @param string $interfaceName Interface name.
     *
     * @return Builder
     */
    public function addInterface($interfaceName)
    {
        $this->interfaces->add($interfaceName);

        if (interface_exists($interfaceName)) {
            $refInterface = new \ReflectionClass($interfaceName);
            $methods = $refInterface->getMethods();
            foreach ($methods as $method) {
                $this->addMethod(new Method(array('name' => $method->getName())));
            }
        }

        return $this;
    }

    /**
     * Sets the interfaces to implement.
     *
     * @param InterfaceCollection|array $interfacesNames
     *
     * @return Builder
     */
    public function setInterfaceCollection($interfacesNames)
    {
        $this->interfaces->clear();
        if (!$interfacesNames instanceof InterfaceCollection) {
            $interfacesNames = new InterfaceCollection($interfacesNames);
        }
        $iterator = $interfacesNames->getIterator();
        foreach ($iterator as $interface) {
            $this->addInterface($interface);
        }

        return $this;
    }

    /**
     * This class is a trait?
     * @return boolean
     */
    public function isTrait()
    {
        return $this->isTrait;
    }

    /**
     * Sets this class is trait.
     *
     * @param boolean $isTrait
     *
     * @return Builder
     */
    public function setIsTrait($isTrait = true)
    {
        $this->isTrait = (bool)$isTrait;

        return $this;
    }

    /**
     * This class is a interface?
     * @return boolean
     */
    public function isInterface()
    {
        return $this->isInterface;
    }

    /**
     * Sets this class is a interface.
     *
     * @param boolean $isInterface
     *
     * @return Builder
     */
    public function setIsInterface($isInterface = true)
    {
        $this->isInterface = (bool)$isInterface;

        return $this;
    }

    /**
     * Sets the class description
     *
     * @param string $description
     *
     * @return Builder
     */
    public function setDescription($description)
    {
        $this->docBlock->setDescription($description);

        return $this;
    }

    /**
     * Gets the collection class use.
     * @return UseCollection
     */
    public function getUseCollection()
    {
        return $this->useCollection;
    }

    /**
     * Adds the use.
     *
     * @param string $fullClassName
     * @param string $alias
     *
     * @return Builder
     */
    public function addUse($fullClassName, $alias = null)
    {
        $this->useCollection->add($fullClassName . ($alias !== null ? ' as ' . $alias : ''));

        return $this;
    }

    /**
     * Sets the uses.
     *
     * @param UseCollection $uses
     *
     * @return Builder
     */
    public function setUseCollection($uses)
    {
        $this->useCollection->clear();
        if (!$uses instanceof UseCollection) {
            $uses = new UseCollection($uses);
        }

        $this->useCollection = $uses;

        return $this;
    }

    /**
     * This class to string.
     * @return string
     */
    public function __toString()
    {
        $type = '';
        $extends = '';

        if ($this->isInterface()) {
            $type = 'interface ';
        } elseif ($this->isAbstract()) {
            $type = 'abstract class ';
        } elseif ($this->isFinal()) {
            $type = 'final class ';
        } elseif ($this->isTrait()) {
            $type = 'trait ';
        } else {
            $type = 'class ';
        }

        if ($this->getExtends()) {
            $extends = ' extends ' . $this->getExtends();
        }
        $string = '<?php' . PHP_EOL
            . $this->getNamespace()->toString()
            . $this->getUseCollection()->toString()
            . $this->getDocBlock()->setTabulation($this->getTabulation())->toString()
            . $type
            . $this->getName()
            . $extends
            . $this->getInterfaceCollection()->toString()
            . PHP_EOL
            . '{'
            . PHP_EOL
            . $this->getConstants()->toString()
            . $this->getProperties()->toString()
            . $this->getMethods()->toString()
            . PHP_EOL
            . '}';

        return $string;
    }

    public function toString()
    {
        return $this->__toString();
    }

    /**
     * Saves the class on file.
     *
     * @param string      $directoryPath
     * @param string|null $fileName
     * @param boolean     $overwrite If exists the file, overwrite it.
     *
     * @throws \Exception
     */
    public function save($directoryPath, $fileName = null, $overwrite = false)
    {
        if (!is_dir($directoryPath)) {
            throw new \Exception('This directory ' . $directoryPath . ' not found');
        }
        if (is_null($fileName)) {
            $fileName = $this->getName();
        }

        $directoryPath = realpath($directoryPath);
        $directoryPath .= DIRECTORY_SEPARATOR
            . str_replace('\\', DIRECTORY_SEPARATOR, $this->getNamespace()->getPath());
        $path = explode(DIRECTORY_SEPARATOR, $directoryPath);
        $dirPath = '';
        foreach ($path as $pathName) {
            $dirPath .= $pathName . DIRECTORY_SEPARATOR;
            if (!is_dir($dirPath)) {
                mkdir($dirPath);
            }
        }
        $fullFileName = $dirPath . $fileName . '.php';
        if ($overwrite || !is_file($fullFileName)) {
            $file = new \SplFileObject($fullFileName, 'w');
            $file->fwrite($this->toString());
        }
    }

    /**
     * Allocates generated class to memory.
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
     * @return Builder
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
     * @return Builder
     */
    public function setIsAbstract($isAbstract = true)
    {
        $this->isAbstract = (bool)$isAbstract;
    }
}
