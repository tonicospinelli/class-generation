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

use ClassGeneration\Collection\ArrayCollection;
use ClassGeneration\Element\ElementAbstract;

/**
 * Constants ClassGeneration
 * @author Antonio Spinelli <tonicospinelli@gmail.com>
 */
class Constant extends ElementAbstract implements ConstantInterface
{

    /**
     * constant's name
     * @var string
     */
    protected $name;

    /**
     * @var mixed
     */
    protected $value;

    /**
     * Alloweds php types.
     * @var ArrayCollection
     */
    protected $allowedTypes;

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
        $this->setDocBlock(new DocBlock());
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * {@inheritdoc}
     */
    public function setValue($value)
    {
        if (!is_string($value) && !is_numeric($value)) {
            throw new \InvalidArgumentException('The constant value must be a string or number');
        }
        $this->value = $value;

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
    public function setDescription($description)
    {
        $this->getDocBlock()->setDescription($description);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getDescription()
    {
        return $this->getDocBlock()->getDescription();
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
     * @return \ClassGeneration\Constant
     */
    public function setDocBlock(DocBlockInterface $docBlock)
    {
        $this->docBlock = $docBlock;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function toString()
    {
        $constant = $this->getDocBlock()->toString()
            . $this->getTabulationFormatted()
            . 'const '
            . mb_strtoupper($this->getName())
            . ' = ' . var_export($this->getValue(), true)
            . ';' . PHP_EOL;

        return $constant;
    }
}
