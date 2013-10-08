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

use ClassGeneration\Element\Documentary;
use ClassGeneration\Element\ElementAbstract;

/**
 * Namespace ClassGeneration
 * @category   ClassGeneration
 * @package    ClassGeneration
 * @copyright  Copyright (c) 2012 ClassGeneration (https://github.com/tonicospinelli/ClassGeneration)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 * @version    ##VERSION##, ##DATE##
 */
class NamespaceClass extends ElementAbstract implements NamespaceInterface, Documentary
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

        $namespace = $this->getDocBlock()->setTabulation($this->getTabulation())->toString()
            . $this->getTabulationFormatted()
            . 'namespace '
            . (strpos($this->getPath(), '\\') === 0 ? substr($this->getPath(), 1) : $this->getPath())
            . ';' . PHP_EOL;

        return $namespace;
    }
}
