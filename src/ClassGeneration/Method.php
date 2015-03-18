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

use ClassGeneration\DocBlock\Tag;
use ClassGeneration\DocBlock\TagInterface;
use ClassGeneration\Element\ElementAbstract;
use ClassGeneration\Element\ElementInterface;
use ClassGeneration\PhpClassInterface;

/**
 * Method ClassGeneration
 * @author Antonio Spinelli <tonicospinelli@gmail.com>
 */
class Method extends ElementAbstract implements MethodInterface
{

    /**
     * Method's name
     * @var string
     */
    protected $name;

    /**
     * Method's arguments.
     * @var ArgumentCollection
     */
    protected $arguments;

    /**
     * Method's code.
     * @var string
     */
    protected $code;

    /**
     * @var string
     */
    protected $visibility = Visibility::TYPE_PUBLIC;

    /**
     * Sets like a final.
     * @var bool
     */
    protected $isFinal;

    /**
     * Sets like an abstract.
     * @var bool
     */
    protected $isAbstract;

    /**
     * Sets like an interface.
     * @var bool
     */
    protected $isInterface;

    /**
     * Sets like a static.
     * @var bool
     */
    protected $isStatic;

    /**
     * Documentation Block.
     * @var DocBlockInterface
     */
    protected $docBlock;

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        $this->setArgumentCollection(new ArgumentCollection());
        $this->setDocBlock(new DocBlock());
        $this->setVisibility(Visibility::TYPE_PUBLIC);
    }

    /**
     * @return PhpClass
     */
    public function getParent()
    {
        return parent::getParent();
    }

    /**
     * @inheritdoc
     */
    public function setParent(ElementInterface $parent)
    {
        if (!$parent instanceof PhpClassInterface) {
            throw new \InvalidArgumentException('Only accept instances from ClassGeneration\PhpClassInterface');
        }

        parent::setParent($parent);

        return $this;
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
        $this->name = lcfirst(str_replace(" ", "", ucwords(strtr($name, "_-", "  "))));
        $this->setCode('//TODO: implements the ' . $this->name . ' method');

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getArgumentCollection()
    {
        return $this->arguments;
    }

    /**
     * @inheritdoc
     */
    public function addArgument(ArgumentInterface $argument)
    {
        $this->getArgumentCollection()->add($argument);
        $tag = Tag::createFromArgument($argument);
        $this->getDocBlock()->addTag($tag);

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function setArgumentCollection(ArgumentCollection $arguments)
    {
        $this->arguments = $arguments;

        return $this;
    }

    /**
     * @inheritdoc
     * @return MethodInterface
     */
    public function setDescription($description)
    {
        $this->docBlock->setDescription($description);

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getDescription()
    {
        return $this->docBlock->getDescription();
    }

    /**
     * @inheritdoc
     */
    public function setReturns(TagInterface $tag)
    {
        $tag->setName(TagInterface::TAG_RETURN);
        $this->getDocBlock()->addTag($tag);

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getReturns()
    {
        return $this->getDocBlock()->getTagsByName('return')->current();
    }

    /**
     * @inheritdoc
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @inheritdoc
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getVisibility()
    {
        return $this->visibility;
    }

    /**
     * @inheritdoc
     * @return Method
     */
    public function setVisibility($visibility)
    {
        Visibility::isValid($visibility);
        $this->visibility = $visibility;

        return $this;
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
     * @return Method
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
     * @return Method
     */
    public function setIsAbstract($isAbstract = true)
    {
        if ($this->isInterface()) {
            throw new \RuntimeException('This method is an interface and it not be an abstract too.');
        }

        $this->isAbstract = (bool)$isAbstract;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function isStatic()
    {
        return $this->isStatic;
    }

    /**
     * {@inheritdoc}
     * @return Method
     */
    public function setIsStatic($isStatic = true)
    {
        $this->isStatic = (bool)$isStatic;

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
     * @return Method
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
     * {@inheritdoc}
     */
    public function getDocBlock()
    {
        return $this->docBlock;
    }

    /**
     * {@inheritdoc}
     * @return Method
     */
    public function setDocBlock(DocBlockInterface $docBlock)
    {
        $this->docBlock = $docBlock;

        return $this;
    }

    protected function codeToString()
    {
        $this->setTabulation($this->getTabulation() * 2);
        $tabulationFormatted = $this->getTabulationFormatted();

        $code = PHP_EOL
            . $tabulationFormatted
            . preg_replace("/\n/", PHP_EOL . $tabulationFormatted, $this->getCode())
            . PHP_EOL;

        return $code;
    }

    /**
     * @inheritdoc
     */
    public function toString()
    {
        $tabulationFormatted = $this->getTabulationFormatted();

        $code = $this->toStringCode();

        $method = $this->getDocBlock()->toString()
            . $tabulationFormatted
            . $this->toStringFunction()
            . $this->getName()
            . '('
            . $this->getArgumentCollection()->toString()
            . ')'
            . $code
            . PHP_EOL;

        return $method;
    }

    /**
     * Get string with method type.
     * @return string
     */
    protected function toStringFunction()
    {
        $string = ($this->isFinal() ? 'final ' : '')
            . ($this->isAbstract() ? 'abstract ' : '')
            . $this->getVisibility() . ' '
            . ($this->isStatic() ? 'static ' : '')
            . 'function ';

        return $string;
    }

    /**
     * Get string code.
     * @return string
     */
    public function toStringCode()
    {
        if (!$this->isInterface() && !$this->isAbstract()) {
            $tabulationFormatted = $this->getTabulationFormatted();
            $code = PHP_EOL . $tabulationFormatted
                . '{'
                . $this->codeToString()
                . $tabulationFormatted
                . '}';

            return $code;
        }

        return ';';
    }

    /**
     * Create a Get Method from Property of Class.
     *
     * @param PropertyInterface $property
     *
     * @return Method
     */
    public static function createGetterFromProperty(PropertyInterface $property)
    {
        $method = new self();
        $method->setName('get_' . $property->getName());
        $method->setCode('return $this->' . $property->getName() . ';');

        return $method;
    }

    /**
     * Generate Set Method from Property.
     * Add a set method in the class based on Object Property.
     *
     * @param PropertyInterface $property
     *
     * @return Method
     */
    public static function createSetterFromProperty(PropertyInterface $property)
    {
        $argument = Argument::createFromProperty($property);

        $code = "\$this->{$property->getName()} = {$argument->getNameFormatted()};"
            . PHP_EOL
            . 'return $this;';

        $method = new self;
        $method
            ->setName('set_' . $property->getName())
            ->setCode($code)
            ->getArgumentCollection()->add($argument);

        return $method;
    }

    /**
     * Creates a method from Reflection Method.
     *
     * @param \ReflectionMethod $reflected
     *
     * @return Method
     */
    public static function createFromReflection(\ReflectionMethod $reflected)
    {
        $method = new self();
        $method->setName($reflected->getName());

        foreach ($reflected->getParameters() as $parameterReflected) {
            $argument = new Argument();
            $argument->setName($parameterReflected->getName());
            $method->addArgument($argument);
        }

        return $method;
    }
}
