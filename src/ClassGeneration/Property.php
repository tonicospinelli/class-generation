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
use ClassGeneration\DocBlockInterface;
use ClassGeneration\Element\ElementAbstract;

/**
 * Property ClassGeneration
 * @author Antonio Spinelli <tonicospinelli@gmail.com>
 */
class Property extends ElementAbstract implements PropertyInterface
{

    /**
     * Property's name
     * @var string
     */
    protected $name;

    /**
     * Property's value.
     * @var mixed
     */
    protected $value;

    /**
     * Property's type.
     * @var string
     */
    protected $type;

    /**
     * Element Visibility.
     * @var string
     */
    protected $visibility;

    /**
     * Element is static.
     * @var bool
     */
    protected $isStatic;

    /**
     * Documentation Block
     * @var DocBlockInterface
     */
    protected $docBlock;

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        $this->setDocBlock(new DocBlock())
            ->setVisibility(Visibility::TYPE_PUBLIC);
    }

    /**
     * Gets the property's name
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets the property's name.
     *
     * @param string $name
     *
     * @return Property
     */
    public function setName($name)
    {
        $this->name = (string)$name;

        return $this;
    }

    /**
     * Gets the property's value.
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Check the property's value.
     * @return boolean
     */
    public function hasValue()
    {
        return (!is_null($this->value) || !empty($this->value));
    }

    /**
     * Sets the property's value.
     *
     * @param mixed $value
     *
     * @throws \InvalidArgumentException
     * @return Property
     */
    public function setValue($value)
    {
        if (is_object($value)) {
            throw new \InvalidArgumentException('Object is not allowed in value for Property.');
        }

        $this->value = $value;

        return $this;
    }

    /**
     * Gets the property's type.
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Sets the property's type.
     *
     * @param string $type
     *
     * @return Property
     */
    public function setType($type)
    {
        $this->type = (string)$type;
        $this->getDocBlock()->getTagCollection()->removeByName(Tag::TAG_VAR);

        $tag = Tag::createFromProperty($this);

        $this->getDocBlock()->addTag($tag);

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
     * @return Property
     */
    public function setDocBlock(DocBlockInterface $docBlock)
    {
        $this->docBlock = $docBlock;

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
     * {@inheritdoc}
     * @return Property
     */
    public function setVisibility($visibility)
    {
        Visibility::isValid($visibility);
        $this->visibility = $visibility;

        return $this;
    }

    /**
     * Is a static element?
     * @return bool
     */
    public function isStatic()
    {
        return $this->isStatic;
    }

    /**
     * Sets this property like static
     *
     * @param bool $isStatic
     *
     * @return Property
     */
    public function setIsStatic($isStatic = true)
    {
        $this->isStatic = (bool)$isStatic;

        return $this;
    }

    /**
     * Gets a description
     * @return string
     */
    public function getDescription()
    {
        return $this->getDocBlock()->getDescription();
    }

    /**
     * Sets a description.
     *
     * @param $description
     *
     * @return Property
     */
    public function setDescription($description)
    {
        $this->getDocBlock()->setDescription($description);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function toString()
    {
        $static = '';
        if ($this->isStatic()) {
            $static = 'static ';
        }

        $value = '';
        if ($this->hasValue()) {
            $value = ' = ' . var_export($this->getValue(), true);
        }

        $property = $this->getDocBlock()->toString() . $this->getTabulationFormatted()
            . $this->getVisibility() . ' '
            . $static
            . '$' . $this->getName()
            . $value
            . ';' . PHP_EOL;

        return $property;
    }
}
