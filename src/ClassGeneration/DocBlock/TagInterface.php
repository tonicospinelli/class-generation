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

use ClassGeneration\Element\ElementInterface;

/**
 * @author Antonio Spinelli <tonicospinelli@gmail.com>
 */
interface TagInterface extends ElementInterface
{

    const TAG_ABSTRACT = 'abstract';

    const TAG_ACCESS = 'access';

    const TAG_AUTHOR = 'author';

    const TAG_CATEGORY = 'category';

    const TAG_COPYRIGHT = 'copyright';

    const TAG_DEPRECATED = 'deprecated';

    const TAG_EXAMPLE = 'example';

    const TAG_FILESOURCE = 'filesource';

    const TAG_FINAL = 'final';

    const TAG_GLOBAL = 'global';

    const TAG_IGNORE = 'ignore';

    const TAG_INTERNAL = 'internal';

    const TAG_LICENSE = 'license';

    const TAG_LINK = 'link';

    const TAG_METHOD = 'method';

    const TAG_NAME = 'name';

    const TAG_PACKAGE = 'package';

    const TAG_PARAM = 'param';

    const TAG_PROPERTY = 'property';

    const TAG_RETURN = 'return';

    const TAG_SEE = 'see';

    const TAG_SINCE = 'since';

    const TAG_STATIC = 'static';

    const TAG_STATICVAR = 'staticvar';

    const TAG_SUBPACKAGE = 'subpackage';

    const TAG_TODO = 'todo';

    const TAG_TUTORIAL = 'tutorial';

    const TAG_USES = 'uses';

    const TAG_VAR = 'var';

    const TAG_VERSION = 'version';

    /**
     * Gets a tag name.
     * @return string
     */
    public function getName();

    /**
     * Sets a tag name.
     *
     * @param int $name
     *
     * @return TagInterface
     */
    public function setName($name);

    /**
     * Get a tag type.
     * @return string
     */
    public function getType();

    /**
     * Sets a tag type.
     *
     * @param string $type
     *
     * @return TagInterface
     */
    public function setType($type);

    /**
     * Gets a variable name.
     * @return string
     */
    public function getVariable();

    /**
     * sets a variavle name.
     *
     * @param string $variable
     *
     * @return TagInterface
     */
    public function setVariable($variable);

    /**
     * Gets the tag description.
     * @return string
     */
    public function getDescription();

    /**
     * Sets the tag description.
     *
     * @param string $description
     *
     * @return TagInterface
     */
    public function setDescription($description);

    /**
     * Get another element (Property or Method).
     * @return ElementInterface
     */
    public function getReferenced();

    /**
     * Sets the element (Property or Method) to reference.
     *
     * @param ElementInterface $referenced
     *
     * @return TagInterface
     */
    public function setReferenced(ElementInterface $referenced);

    /**
     * Is inline documentation?
     * @return boolean
     */
    public function isInline();

    /**
     * Set inline documentation.
     *
     * @param bool $isInline
     *
     * @return TagInterface
     */
    public function setIsInline($isInline = true);
}
