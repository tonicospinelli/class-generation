<?php

namespace ClassGeneration\Test\Provider;

trait ObjectTrait
{
    public function doSomething()
    {
        return true;
    }

    protected function doNothing()
    {
        return false;
    }
}
