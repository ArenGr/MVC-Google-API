<?php

namespace App\Core\Container_back\Definitions;

use App\Core\Container_back\Interfaces\DefinitionInterface;

abstract class AbstractDefinition implements DefinitionInterface
{
    /**
     * Arguments
     * @var array
     */
    public $arguments = [];

    /**
     * Add Arguments
     *
     * @param array $args
     */
    public function addArguments(array $args) : void
    {
        $this->arguments = $args;
    }

    /**
     * Has Arguments
     *
     * @return bool
     */
    public function hasArguments() : bool
    {
        return count($this->arguments) > 0;
    }
}
