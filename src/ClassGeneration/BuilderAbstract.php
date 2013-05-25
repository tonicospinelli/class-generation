<?php

/**
 * ClassGeneration
 *
 * Copyright (c) 2012 ClassGeneration
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @category   ClassGeneration
 * @package    ClassGeneration
 * @copyright  Copyright (c) 2012 ClassGeneration (https://github.com/tonicospinelli/ClassGeneration)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 * @version    ##VERSION##, ##DATE##
 */

namespace ClassGeneration;

use ClassGeneration\DocBlock\Tag;

/**
 * Abstract ClassGeneration
 *
 * @category   ClassGeneration
 * @package    ClassGeneration
 * @copyright  Copyright (c) 2012 ClassGeneration (https://github.com/tonicospinelli/ClassGeneration)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 * @version    ##VERSION##, ##DATE##
 */
abstract class BuilderAbstract
{

    /**
     * Tabulation Identity.
     *
     * @var int
     */
    protected $tabulation = 4;

    /**
     * Parent Class.
     *
     * @var Builder
     */
    protected $ownerClass = null;

    /**
     * Documentation Block.
     *
     * @var DocBlock
     */
    protected $docBlock;

    /**
     * Element Visibility.
     *
     * @var string
     */
    protected $visibility;

    /**
     * Element is static.
     *
     * @var bool
     */
    protected $isFinal;

    /**
     * Element is static.
     *
     * @var bool
     */
    protected $isStatic;

    /**
     * Element is abstract.
     *
     * @var bool
     */
    protected $isAbstract;

    abstract public function init();

    abstract public function toString();

    abstract public function __toString();

    public function __construct($options = array())
    {
        $this->getDocBlock();
        $this->init();
        $this->setOptions($options);
    }

    /**
     * Gets the owner class.
     *
     * @return Builder|null
     */
    public function getOwnerClass()
    {
        return $this->ownerClass;
    }

    /**
     * Sets the owner class.
     *
     * @param Builder $ownerClass
     *
     * @return BuilderAbstrat
     */
    public function setOwnerClass(&$ownerClass)
    {
        $this->ownerClass = $ownerClass;

        return $this;
    }

    /**
     * Returns the DocBlock Object.
     *
     * @return DocBlock
     */
    public function getDocBlock()
    {
        if (!$this->docBlock instanceof DocBlock) {
            $this->docBlock = new DocBlock();
        }

        return $this->docBlock;
    }

    /**
     * Sets the DocBlock Object.
     *
     * @param DocBlock $docBlock
     *
     * @return BuilderAbstract
     */
    public function setDocBlock(DocBlock $docBlock)
    {
        $this->docBlock = $docBlock;

        return $this;
    }

    /**
     * Sets the properties.
     *
     * @param array $options
     *
     * @return BuilderAbstract
     */
    public function setOptions(array $options)
    {
        foreach ($options as $prop => $option) {
            $method = 'set' . ucfirst($prop);
            if (method_exists($this, $method)) {
                $this->$method($option);
            }
        }

        return $this;
    }

    /**
     * Tabulation class.
     *
     * @return int
     */
    public function getTabulation()
    {
        return $this->tabulation;
    }

    /**
     * Tabulation fomatted
     *
     * @return string
     */
    public function getTabulationFormatted()
    {
        return str_repeat(' ', $this->getTabulation());
    }

    /**
     * Set tabulation spaces.
     *
     * @param int $tabulation
     */
    public function setTabulation($tabulation)
    {
        $this->tabulation = (int)$tabulation;
    }

    /**
     * Is a final element?
     *
     * @return boolean
     */
    public function isFinal()
    {
        return $this->isFinal;
    }

    /**
     * Sets this class is final.
     *
     * @param boolean $isFinal
     *
     * @return ClassGeneration
     */
    public function setIsFinal($isFinal = true)
    {
        $this->isFinal = (bool)$isFinal;

        return $this;
    }

    /**
     * Is a abstract element?
     *
     * @return boolean
     */
    public function isAbstract()
    {
        return $this->isAbstract;
    }

    /**
     * Sets this class is abstract.
     *
     * @param boolean $isAbstract
     *
     * @return ClassGeneration
     */
    public function setIsAbstract($isAbstract = true)
    {
        $this->isAbstract = (bool)$isAbstract;

        return $this;
    }

    /**
     * Is a static element?
     *
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
     */
    public function setIsStatic($isStatic = true)
    {
        $this->isStatic = (bool)$isStatic;
    }

    /**
     * Gets the element visibility.
     *
     * @return string
     */
    public function getVisibility()
    {
        return $this->visibility;
    }

    /**
     * Sets the element visibility.
     *
     * @param string $visibility Use the constants in the Visibility.
     * @param bool   $forceInDocBlock
     *
     * @throws \Exception If the visibility is not found.
     * @return BuilderAbstract
     */
    public function setVisibility($visibility, $forceInDocBlock = false)
    {
        switch ($visibility) {
            case Visibility::TYPE_PRIVATE:
            case Visibility::TYPE_PROTECTED:
            case Visibility::TYPE_PUBLIC:
                $this->visibility = $visibility;
                if ($forceInDocBlock) {
                    $tag = new Tag(
                        array(
                            'name' => Tag::TAG_ACCESS,
                            'type' => $visibility
                        )
                    );
                    $this->docBlock->addTag($tag);
                }
                break;
            default:
                throw new \Exception('This visibility (' . $visibility . ') not allowed');
                break;
        }
        return $this;
    }

    /**
     * Mask value to string.
     *
     * @param mixed $value
     *
     * @return string
     */
    public function maskValue($value)
    {
        switch (gettype($value)) {
            case 'float':
            case 'decimal':
            case 'double':
                $value = preg_replace('/0[0]*$/', '0', sprintf('%f', $value));
                break;
            case 'int':
            case 'integer':
                $value = sprintf('%d', $value);
                break;
            case 'string':
                $value = "'{$value}'";
                break;
            case 'bool':
            case 'boolean':
                $value = $value ? 'true' : 'false';
                break;
            case 'array':
                $value = $this->arrayToString($value);
                break;
            case 'null':
                $value = 'null';
                break;
        }
        return $value;
    }

    /**
     * Formats array to string and preserve structure.
     *
     * @param array $array
     *
     * @return string
     */
    protected function arrayToString($array)
    {
        $strings = array();
        if (is_array($array)) {
            foreach ($array as $key => $value) {
                if (is_int($key)) {
                    $strings[] = $this->maskValue($value);
                } else {
                    $strings[] = $key . ' => ' . $this->maskValue($value);
                }
            }
        } else {
            $strings[] = $this->maskValue($array);
        }

        return 'array(' . implode(', ', $strings) . ')';
    }
}
