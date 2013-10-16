<?php
/**
 * Created by JetBrains PhpStorm.
 * User: aspinelli
 * Date: 16/10/13
 * Time: 15:28
 * To change this template use File | Settings | File Templates.
 */

namespace ClassGeneration;

interface WriterInterface
{

    /**
     * Class to write a file from Class Object.
     *
     * @param PhpClassInterface|array $class
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
     */
    public function write();
}