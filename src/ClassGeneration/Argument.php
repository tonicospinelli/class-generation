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

use ClassGeneration\Element\ElementAbstract;

/**
 * Argument ClassGeneration
 * @author Antonio Spinelli <tonicospinelli@gmail.com>
 */
class Argument extends ElementAbstract implements ArgumentInterface
{

    /**
     * Argument's name.
     * @var string
     */
    protected $name;

    /**
     * Argument's default value.
     * @var mixed
     */
    protected $value;

    /**
     * Argument's is optional.
     * @var bool
     */
    protected $isOptional = false;

    /**
     * Argument's description.
     * @var string
     */
    protected $description;

    /**
     * Argument's type.
     * @var string
     */
    protected $type;

    /**
     * Primitive types.
     * @var array
     */
    protected $primitiveTypes = array(
        'bool', 'boolean',
        'decimal', 'double',
        'float',
        'int', 'integer',
        'number',
        'string',
        'resource',
    );

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        $this->setIsOptional(false);
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
    public function getNameFormatted()
    {
        return '$' . $this->getName();
    }

    /**
     * {@inheritdoc}
     */
    public function setName($name)
    {
        $this->name = (string)$name;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * {@inheritdoc}
     */
    public function setValue($value)
    {
        $this->value = $value;
        $this->setIsOptional();

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function isOptional()
    {
        return $this->isOptional;
    }

    /**
     * {@inheritdoc}
     */
    public function setIsOptional($isOptional = true)
    {
        $this->isOptional = (bool)$isOptional;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * {@inheritdoc}
     */
    public function hasType()
    {

        return (!is_null($this->type) || !empty($this->type))
        && !in_array(mb_strtolower($this->type), $this->primitiveTypes);
    }

    /**
     * {@inheritdoc}
     */
    public function setType($type)
    {
        $this->type = (string)$type;

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
     * {@inheritdoc}
     */
    public function toString()
    {
        $type = '';
        if ($this->hasType()) {
            $type = $this->getType() . ' ';
        }
        $value = '';
        if ($this->isOptional()) {
            $value = ' = ' . var_export($this->getValue(), true);
        }
        $argument = trim(
            $type
            . $this->getNameFormatted()
            . $value
        );

        return $argument;
    }

    /**
     * Creates Argument from Property Object.
     *
     * @param PropertyInterface $property
     *
     * @return Argument
     */
    public static function createFromProperty(PropertyInterface $property)
    {
        $argument = new self();
        $argument
            ->setName($property->getName())
            ->setType($property->getType());

        return $argument;
    }
}
