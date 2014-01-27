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

/**
 * Class WriterInterface
 * @author Antonio Spinelli <tonicospinelli@gmail.com>
 */
interface WriterInterface
{

    /**
     * Class to write a file from Class Object.
     *
     * @param PhpClassInterface|array $class
     *
     * @return WriterInterface
     */
    public function __construct($class = array());

    /**
     * @param PhpClassInterface $class
     *
     * @return WriterInterface
     */
    public function setPhpClass(PhpClassInterface $class);

    /**
     * @return PhpClassInterface
     */
    public function getPhpClass();

    /**
     * @param string $path
     *
     * @return WriterInterface
     */
    public function setPath($path);

    /**
     * @return string
     */
    public function getPath();

    /**
     * @param $fileName
     *
     * @return WriterInterface
     */
    public function setFileName($fileName);

    /**
     * @return string
     */
    public function getFileName();

    /**
     * Writes the class on file.
     * @return void
     */
    public function write();
}
