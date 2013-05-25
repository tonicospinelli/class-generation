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

namespace ClassGeneration\DocBlock;

use ClassGeneration\Collection\ArrayCollection;

/**
 * Tag DocBlock ClassGeneration
 *
 * @category   ClassGeneration
 * @package    ClassGeneration\DocBlock
 * @copyright  Copyright (c) 2012 ClassGeneration (https://github.com/tonicospinelli/ClassGeneration)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 * @version    ##VERSION##, ##DATE##
 */
class Tag
{

    const TAG_ABSTRACT = 0;

    const TAG_ACCESS = 1;

    const TAG_AUTHOR = 2;

    const TAG_CATEGORY = 3;

    const TAG_COPYRIGHT = 4;

    const TAG_DEPRECATED = 5;

    const TAG_EXAMPLE = 6;

    const TAG_FILESOURCE = 7;

    const TAG_FINAL = 8;

    const TAG_GLOBAL = 9;

    const TAG_IGNORE = 10;

    const TAG_INTERNAL = 11;

    const TAG_LICENSE = 12;

    const TAG_LINK = 13;

    const TAG_METHOD = 14;

    const TAG_NAME = 15;

    const TAG_PACKAGE = 16;

    const TAG_PARAM = 17;

    const TAG_PROPERTY = 18;

    const TAG_RETURN = 19;

    const TAG_SEE = 20;

    const TAG_SINCE = 21;

    const TAG_STATIC = 22;

    const TAG_STATICVAR = 23;

    const TAG_SUBPACKAGE = 24;

    const TAG_TODO = 25;

    const TAG_TUTORIAL = 26;

    const TAG_USES = 27;

    const TAG_VAR = 28;

    const TAG_VERSION = 29;

    /**
     * Tag Name.
     *
     * @var string
     */
    protected $name;

    /**
     * Tag Type.
     *
     * @var string
     */
    protected $type;

    /**
     * Define a parameter name.
     *
     * @var string
     */
    protected $variable;

    /**
     * Tag Description.
     *
     * @var string
     */
    protected $description;

    /**
     * Element Referenced.
     *
     * @var mixed
     */
    protected $referenced;

    /**
     * Tag's List.
     *
     * @var ArrayCollection
     */
    protected $tagList;

    /**
     * Tags containing type.
     *
     * @var ArrayCollection
     */
    protected $tagHasTypes;

    /**
     * Create tag by options.
     * <code>
     * $options = array(
     *  'name' => \ClassGeneration\DocBlock\Tag::TAG_PARAM,
     *  'type' => 'string',
     *  'variable' => 'test',
     *  'description' => 'New test with argument',
     * );
     * $tag = new \ClassGeneration\DocBlock\Tag($options);
     * </code>
     *
     * @param array $options
     */
    public function __construct($options = array())
    {
        $this->tagHasTypes = new ArrayCollection(
            array('access', 'param', 'property', 'method', 'return', 'throws', 'var')
        );
        $this->tagList = new ArrayCollection(
            array(
                'abstract', 'access', 'author',
                'category', 'copyright',
                'deprecated',
                'example',
                'filesource', 'final',
                'global',
                'ignore', 'internal',
                'license', 'link',
                'method',
                'name',
                'package', 'param', 'property',
                'return',
                'see', 'since', 'static', 'staticvar', 'subpackage',
                'todo', 'tutorial',
                'uses',
                'var', 'version',
            )
        );
        $this->setOptions($options);
    }

    /**
     * Populate the properies from array.
     *
     * @param array $options
     *
     * @return \ClassGeneration\DocBlock\Tag
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
     * Gets a tag name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets a tag name.
     *
     * @param int $name
     *
     * @return \ClassGeneration\DocBlock\Tag
     */
    public function setName($name)
    {
        if (!$this->validateTag($name)) {
            throw new \Exception('This tag name ' . $name . ' not found');
        }

        if (is_numeric($name)) {
            $name = $this->tagList->get($name);
        }

        $this->name = $name;

        return $this;
    }

    /**
     * Get a tag type.
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Sets a tag type.
     *
     * @param string $type
     *
     * @return \ClassGeneration\DocBlock\Tag
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Gets a variable name.
     *
     * @return type
     */
    public function getVariable()
    {
        return $this->variable;
    }

    /**
     * sets a variavle name.
     *
     * @param string $variable
     *
     * @return \ClassGeneration\DocBlock\Tag
     */
    public function setVariable($variable)
    {
        $this->variable = $variable;

        return $this;
    }

    /**
     * Gets the tag description.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Sets the tag description.
     *
     * @param string $description
     *
     * @return \ClassGeneration\DocBlock\Tag
     */
    public function setDescription($description)
    {
        $this->description = nl2br($description);

        return $this;
    }

    /**
     * Validate if the Tag Name is valid.
     *
     * @param int $tagName
     *
     * @return boolean
     * @throws Exception
     */
    protected function validateTag($tagName)
    {
        if (is_string($tagName)) {
            return $this->tagList->contains($tagName);
        }

        return $this->tagList->containsKey($tagName);
    }

    /**
     * This tag, has type?
     *
     * @param string $tagName
     *
     * @return bool
     */
    protected function hasType($tagName)
    {
        return $this->tagHasTypes->contains($tagName);
    }

    /**
     * Get another element (Property or Method).
     *
     * @return mixed
     */
    public function getReferenced()
    {
        return $this->referenced;
    }

    /**
     * Sets the element (Property or Method) to reference.
     *
     * @param mixed $referenced
     *
     * @return \ClassGeneration\DocBlock\Tag
     */
    public function setReferenced($referenced)
    {
        $this->referenced = $referenced;

        return $this;
    }

    /**
     * Parse the tag to string.
     *
     * @return string
     */
    public function toString()
    {
        return $this->__toString();
    }

    /**
     * Parse the tag to string.
     *
     * @return string
     */
    public function __toString()
    {
        $strings = array();

        foreach ($this as $key => $value) {
            if (!method_exists($this, 'get' . ucfirst($key)) OR ($key == 'referenced')) {
                continue;
            }

            switch ($key) {
                case 'name':
                    $strings[] = '@' . $value;
                    break;
                case 'variable':
                    if (!is_null($value) AND !empty($value)) {
                        $strings[] = '$' . $value;
                    }
                    break;
                case 'type':
                    $name = $this->getName();
                    if ($name === 'return' AND ($value !== false AND !is_null($value) AND !empty($value))) {
                        $strings[] = $value;
                    } elseif ($this->hasType($name)) {
                        $strings[] = (is_null($value) OR empty($value)) ? 'type' : $value;
                    }
                    break;
                default:
                    $strings[] = $value;
                    break;
            }
        }

        return trim(implode(' ', $strings)) . PHP_EOL;
    }
}
