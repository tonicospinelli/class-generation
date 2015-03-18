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

use ClassGeneration\Element\DocumentBlockInterface;
use ClassGeneration\Element\ElementAbstract;

/**
 * Namespace ClassGeneration
 * @author Antonio Spinelli <tonicospinelli@gmail.com>
 */
class NamespaceClass extends ElementAbstract implements NamespaceInterface, DocumentBlockInterface
{

    /**
     * @var mixed
     */
    protected $path;

    /**
     * Documentation Block
     * @var DocBlockInterface
     */
    protected $docBlock;

    /**
     * @param array|string $options
     */
    public function __construct($options = array())
    {
        if (is_string($options)) {
            $options = array('path' => $options);
        }
        parent::__construct($options);
    }

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        $this->setTabulation(0);
        $this->setDocBlock(new DocBlock());
    }

    /**
     * Gets the path.
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Sets the Path.
     *
     * @param string $path
     *
     * @return NamespaceClass
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Sets the namespace's description.
     *
     * @param string $description
     *
     * @return NamespaceClass
     */
    public function setDescription($description)
    {
        $this->getDocBlock()->setDescription($description);

        return $this;
    }

    /**
     * Gets the namespace's description.
     * @return string
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
     * @return NamespaceClass
     */
    public function setDocBlock(DocBlockInterface $docBlock)
    {
        $this->docBlock = $docBlock;

        return $this;
    }

    /**
     * Parse the namespace string;
     * @return string
     */
    public function toString()
    {
        if (!$this->getPath()) {
            return '';
        }

        $path = preg_replace('/^\\\/', '', $this->getPath());

        $namespace = $this->getDocBlock()->setTabulation($this->getTabulation())->toString()
            . $this->getTabulationFormatted()
            . 'namespace '
            . $path
            . ';' . PHP_EOL;

        return $namespace;
    }
}
