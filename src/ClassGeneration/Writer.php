<?php

namespace ClassGeneration;

use ClassGeneration\Element\ElementAbstract;

class Writer extends ElementAbstract implements WriterInterface
{

    protected $fileName;

    /**
     * @var PhpClassInterface
     */
    protected $phpClass;

    /**
     * @var string
     */
    protected $path;

    /**
     * @inheritdoc
     */
    public function __construct($class = null)
    {
        if (is_array($class)) {
            $this->setOptions($class);
        }
        if ($class instanceof PhpClassInterface) {
            $this->setPhpClass($class);
        }
        $this->init();
    }

    /**
     * @{inheritdoc}
     */
    public function init()
    {
    }

    /**
     * @inheritdoc
     */
    public function setPhpClass(PhpClassInterface $class)
    {
        $this->phpClass = $class;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getPhpClass()
    {
        return $this->phpClass;
    }

    /**
     * @inheritdoc
     */
    public function setPath($path)
    {
        if (!is_dir($path) or !is_writable($path)) {
            throw new \RuntimeException('This directory ' . $path . ' not exists or not writable');
        }

        $this->path = $path;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @inheritdoc
     */
    public function setFileName($fileName)
    {
        $this->fileName = $fileName;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getFileName()
    {
        return (!is_null($this->fileName) ? $this->fileName : $this->getPhpClass()->getName());
    }

    /**
     * @inheritdoc
     */
    public function write()
    {
        $fileName = $this->getFileName();

        $directoryPath = realpath($this->getPath());
        $namespace = $this->getPhpClass()->getNamespace()->getPath();

        $directoryPath .= DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $namespace);
        $fullFileName = $directoryPath . DIRECTORY_SEPARATOR . $fileName . '.php';
        if (!is_dir($directoryPath)) {
            mkdir($directoryPath, 0777, true);
        }
        $file = new \SplFileObject($fullFileName, 'w');
        $file->fwrite($this->getPhpClass()->toString());
    }

    /**
     * @inheritdoc
     */
    public function toString()
    {
        throw new \RuntimeException('toString is not applicable in this context');
    }
}
