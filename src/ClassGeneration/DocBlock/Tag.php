<?php

/*
 * This file is part of the ClassGeneration package.
 *
 * (c) Antonio Spinelli <tonicospinelli@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ClassGeneration\DocBlock;

use ClassGeneration\ArgumentInterface;
use ClassGeneration\Collection\ArrayCollection;
use ClassGeneration\Element\ElementAbstract;
use ClassGeneration\Element\ElementInterface;
use ClassGeneration\PropertyInterface;

/**
 * @author Antonio Spinelli <tonicospinelli@gmail.com>
 */
class Tag extends ElementAbstract implements TagInterface
{

    /**
     * Tag Name.
     * @var string
     */
    protected $name;

    /**
     * Tag Type.
     * @var string
     */
    protected $type;

    /**
     * Define a parameter name.
     * @var string
     */
    protected $variable;

    /**
     * Tag Description.
     * @var string
     */
    protected $description;

    /**
     * Element Referenced.
     * @var ElementInterface
     */
    protected $referenced;

    /**
     * Tags containing type.
     * @var ArrayCollection
     */
    protected $tagNeedsType;

    /**
     * Inline documentation, that is to put {} around of the text.
     * @var boolean
     */
    protected $isInline = false;

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        $this->tagNeedsType = new ArrayCollection(
            array('access', 'param', 'property', 'method', 'return', 'throws', 'var')
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * {@inheritdoc}
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getType()
    {
        if ((is_null($this->type) || empty($this->type)) && $this->needsType()) {
            return 'mixed';
        }

        return $this->type;
    }

    /**
     * {@inheritdoc}
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getVariable()
    {
        return $this->variable;
    }

    /**
     * {@inheritdoc}
     */
    public function setVariable($variable)
    {
        $this->variable = $variable;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * {@inheritdoc}
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * This tag, has type?
     * @return bool
     */
    protected function needsType()
    {
        return $this->tagNeedsType->contains($this->getName());
    }

    /**
     * {@inheritdoc}
     */
    public function getReferenced()
    {
        return $this->referenced;
    }

    /**
     * {@inheritdoc}
     */
    public function setReferenced(ElementInterface $referenced)
    {
        $this->referenced = $referenced;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function isInline()
    {
        return $this->isInline;
    }

    /**
     * {@inheritdoc}
     */
    public function setIsInline($isInline = true)
    {
        $this->isInline = (bool)$isInline;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function toString()
    {
        $name = $this->getName();
        $variable = $this->getVariable();
        $type = $this->getType();
        $description = $this->getDescription();
        $string =
            '@' . $name
            . ((!is_null($type) && !empty($type)) ? ' ' . $type : '')
            . ((!is_null($variable) && !empty($variable)) ? ' $' . $variable : '')
            . ((!is_null($description) && !empty($description)) ? ' ' . $description : '');

        $string = trim($string);
        if ($this->isInline()) {
            return '{' . $string . '}' . PHP_EOL;
        }

        return $string . PHP_EOL;
    }

    /**
     * Creating a Tag from an Argument Object.
     *
     * @param ArgumentInterface $argument
     *
     * @return TagInterface
     */
    public static function createFromArgument(ArgumentInterface $argument)
    {
        $tag = new self();
        $tag
            ->setName(self::TAG_PARAM)
            ->setType($argument->getType())
            ->setVariable($argument->getName())
            ->setDescription($argument->getDescription())
            ->setReferenced($argument);

        return $tag;
    }

    /**
     * Create var tag from property.
     *
     * @param PropertyInterface $property
     *
     * @return Tag
     */
    public static function createFromProperty(PropertyInterface $property)
    {
        $tag = new self();
        $tag->setName(self::TAG_VAR);
        $tag->setType($property->getType());

        return $tag;
    }
}
