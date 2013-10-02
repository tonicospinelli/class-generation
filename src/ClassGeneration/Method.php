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

/**
 * Method ClassGeneration
 * @category   ClassGeneration
 * @package    ClassGeneration
 * @copyright  Copyright (c) 2012 ClassGeneration (https://github.com/tonicospinelli/ClassGeneration)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 * @version    ##VERSION##, ##DATE##
 */
class Method extends BuilderAbstract
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
     * Initialize.
     */
    public function init()
    {
        $this->arguments = new ArgumentCollection();
        $this->setVisibility(Visibility::TYPE_PUBLIC);
    }

    /**
     * Set the owner class
     *
     * @param \ClassGeneration\Builder $ownerClass
     *
     * @return Method
     */
    public function setOwnerClass(&$ownerClass)
    {
        parent::setOwnerClass($ownerClass);
        $description = ($this->getReturns() instanceof Tag ? $this->getReturns()->getDescription() : '');

        if (is_null($this->getCode())) {
            $this->setCode(
                str_replace(
                    $this->getName(),
                    $this->getOwnerClass()->getFullName() . '::' . $this->getName(),
                    $this->getCode()
                )
            );
        }
        if (preg_match('/return \$this;.*$/', $this->getCode())) {
            $this->setReturns('\\' . $this->getOwnerClass()->getFullName(), $description);
        }

        return $this;
    }

    /**
     * Gets the method's name
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets the method's name.
     *
     * @param string $name
     *
     * @return Method
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
     * Gets the Arguments Colletion.
     * @return ArgumentCollection
     */
    public function getArguments()
    {
        return $this->arguments;
    }

    /**
     * Gets the Argument Object.
     *
     * @param string $argumentName
     *
     * @return Argument
     */
    public function getArgument($argumentName)
    {
        return $this->arguments->offsetGet($argumentName);
    }

    /**
     * Remove the argument by name.
     *
     * @param string $argumentName
     *
     * @return Argument
     */
    public function removeArgumentByName($argumentName)
    {
        $params = $this->arguments->removeByName($argumentName);
        $this->docBlock->removeTagsByReference($params->getIterator()->current());

        return $params;
    }

    /**
     * Add a new Argument Object.
     *
     * @param Argument $argument
     *
     * @return Method
     */
    public function addArgument(Argument $argument)
    {
        $this->arguments->add($argument);
        $this->docBlock->addTag(
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
     * Arguments's list.
     *
     * @param ArgumentCollection|\ReflectionParameter|array $arguments \ClassGeneration\Arguments's array.
     *
     * @return Method
     */
    public function setArguments($arguments)
    {
        if (!$arguments instanceof ArgumentCollection) {
            $arguments = new ArgumentCollection($arguments);
        }
        foreach ($arguments as $argument) {
            $this->addArgument($argument);
        }

        return $this;
    }

    /**
     * Adds a new tag in DockBlock.
     *
     * @param Tag $tag
     */
    public function addDocBlockTag(Tag $tag)
    {
        $this->docBlock->addTag($tag);
    }

    /**
     * Sets the property's description.
     *
     * @param string $description
     *
     * @return Method
     */
    public function setDescription($description)
    {
        $this->docBlock->setDescription($description);

        return $this;
    }

    /**
     * Gets the property's description.
     * @return string
     */
    public function getDescription()
    {
        return $this->docBlock->getDescription();
    }

    /**
     * Sets the property's description.
     *
     * @param string $type
     * @param string $description
     *
     * @return Method
     */
    public function setReturns($type, $description = null)
    {
        $tag = new Tag(
            array(
                'name'        => Tag::TAG_RETURN,
                'type'        => $type,
                'description' => $description
            )
        );

        $this->docBlock->addTag($tag);

        return $this;
    }

    /**
     * Sets the property's description.
     * @return Tag
     */
    public function getReturns()
    {
        return $this->docBlock->getTagsByName('return')->current();
    }

    /**
     * Method's code
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Method's code
     *
     * @param string $code
     *
     * @return Method
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
     * Parse the property string.
     * @return string
     */
    public function toString()
    {
        return $this->__toString();
    }

    /**
     * Parse the property string.
     * @return string
     */
    public function __toString()
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

        $method = $this->docBlock->toString()
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
            . PHP_EOL
            . $tabulationFormatted
            . '{'
            . PHP_EOL
            . $tabulationFormattedCode
            . preg_replace("/\n/", PHP_EOL . $tabulationFormattedCode, $this->getCode())
            . PHP_EOL
            . $tabulationFormatted
            . '}'
            . PHP_EOL;

        return $method;
    }
}
