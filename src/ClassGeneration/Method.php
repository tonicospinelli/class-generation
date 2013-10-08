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
use ClassGeneration\DocBlock\TagInterface;
use ClassGeneration\Element\Declarable;
use ClassGeneration\Element\Documentary;
use ClassGeneration\Element\ElementAbstract;
use ClassGeneration\Element\ElementInterface;
use ClassGeneration\Element\StaticInterface;
use ClassGeneration\Element\VisibilityInterface;
use ClassGeneration\PhpClassInterface;

/**
 * Method ClassGeneration
 * @category   ClassGeneration
 * @package    ClassGeneration
 * @copyright  Copyright (c) 2012 ClassGeneration (https://github.com/tonicospinelli/ClassGeneration)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 * @version    ##VERSION##, ##DATE##
 */
class Method extends ElementAbstract implements MethodInterface, VisibilityInterface, Declarable, StaticInterface, Documentary
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
    protected $visibility;

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
        $description = ($this->getReturns() instanceof TagInterface ? $this->getReturns()->getDescription() : '');

        if (is_null($this->getCode())) {
            $this->setCode(
                str_replace(
                    $this->getName(),
                    $this->getParent()->getFullName() . '::' . $this->getName(),
                    $this->getCode()
                )
            );
        }
        if (preg_match('/return \$this;.*$/', $this->getCode())) {
            $this->setReturns(
                new Tag(
                    array(
                        'name'        => $this->getParent()->getFullName(),
                        'description' => $description,
                    )
                )
            );
        }

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
        if (preg_match('/^__/', $name)) {
            $this->name = $name;
        } else {
            $this->name = lcfirst(str_replace(" ", "", ucwords(strtr($name, "_-", "  "))));
        }
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
        $this->arguments->add($argument);
        $this->getDocBlock()->addTag(
            new Tag(
                array(
                    'name'        => Tag::TAG_PARAM,
                    'type'        => $argument->getType(),
                    'variable'    => $argument->getName(),
                    'description' => $argument->getDescription(),
                    'referenced'  => $this->arguments->offsetGet($argument->getName())
                )
            )
        );

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
        if (preg_match('/return /', $code) AND $this->getReturns() instanceof Tag
            AND $this->getReturns()->getType() === 'type'
        ) {
            $this->setReturns(null);
        }

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

    /**
     * @inheritdoc
     */
    public function toString()
    {
        $defaultTabulation = $this->getTabulation();
        $tabulationFormatted = $this->getTabulationFormatted();

        $this->setTabulation($defaultTabulation + $defaultTabulation);
        $tabulationFormattedCode = $this->getTabulationFormatted();

        $final = '';
        if ($this->isFinal()) {
            $final = 'final ';
        }

        $abstract = '';
        if ($this->isAbstract()) {
            $abstract = 'abstract ';
        }

        $static = '';
        if ($this->isStatic()) {
            $static = 'static ';
        }

        $visibility = '';
        if ($this->getVisibility()) {
            $visibility = $this->getVisibility() . ' ';
        }

        if (!$this->isInterface() AND !$this->isAbstract()) {
            $code = PHP_EOL
                . $tabulationFormatted
                . '{'
                . PHP_EOL
                . $tabulationFormattedCode
                . preg_replace("/\n/", PHP_EOL . $tabulationFormattedCode, $this->getCode())
                . PHP_EOL
                . $tabulationFormatted
                . '}';
        } else {
            $code = ';';
        }

        $method = $this->getDocBlock()->toString()
            . $tabulationFormatted
            . $final
            . $abstract
            . $visibility
            . $static
            . 'function '
            . $this->getName()
            . '('
            . $this->arguments->implode()
            . ')'
            . $code
            . PHP_EOL;

        return $method;
    }
}
