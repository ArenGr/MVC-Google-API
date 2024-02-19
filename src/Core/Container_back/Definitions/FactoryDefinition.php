<?php

namespace Core\Container\Definitions;

use Closure;
use Core\Container\Definitions\AbstractDefinition;

class FactoryDefinition extends AbstractDefinition
{
    /**
     * Callback
     * @var Closure
     */
    private $callback;

    /**
     * Constructor
     *
     * @param Closure $callback
     */
    public function __construct(Closure $callback)
    {
        $this->callback = $callback;
    }

    /**
     * Build
     *
     * @return object
     */
    public function build()
    {
        return call_user_func_array($this->callback, $this->arguments);
    }
}
