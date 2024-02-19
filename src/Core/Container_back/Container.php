<?php
namespace App\Core\Container_back;

use Closure;
use Psr\Container\ContainerInterface;
use App\Core\Container_back\Definitions\ClassDefinition;
use App\Core\Exceptions\NotFoundException;
use App\Core\Container_back\Definitions\SetterDefinition;
use App\Core\Container_back\Definitions\FactoryDefinition;
use App\Core\Container_back\Interfaces\DefinitionInterface;

class Container implements ContainerInterface
{
    /**
     * Arguments
     * @var array
     */
    private $arguments = [];

    /**
     * Definitions
     * @var array
     */
    private $definitions = [];

    /**
     * Add
     *
     * Adds a definition to the $definition array.
     *
     * @param string              $alias
     * @param DefinitionInterface $definition
     */
    public function add(string $alias, DefinitionInterface $definition) : void
    {
        $this->definitions[$alias] = $definition;
    }

    /**
     * Add Class
     *
     * Add a class to the container.
     *
     * @param string $alias
     * @param string $concrete
     */
    public function addClass(string $alias, string $concrete) : void
    {
        $definition = new ClassDefinition($concrete);

        $this->add($alias, $definition);
    }

    /**
     * Add Factory
     *
     * Adds a factory definition to the container.
     *
     * @param string  $alias
     * @param Closure $callback
     */
    public function addFactory(string $alias, Closure $callback) : void
    {
        $definition = new FactoryDefinition($callback);

        $this->add($alias, $definition);
    }

    /**
     * Add Setter
     *
     * @param string $alias
     * @param string $concrete
     * @param array  $methods
     */
    public function addSetter(string $alias, string $concrete, array $methods) : void
    {
        $definition = new SetterDefinition($concrete, $methods);

        $this->add($alias, $definition);
    }

    /**
     * Get
     *
     * Returns the passed alias.
     *
     * @param  string $id
     * @return mixed
     * @throws NotFoundException
     */
    public function get($id)
    {
        if (!$this->has($id)) {
            throw new NotFoundException(sprintf('%s is not defined.', $id));
        }

        $definition = $this->definitions[$id];
        $definition->addArguments($this->arguments);

        return $definition->build();
    }

    /**
     * Has
     *
     * Does the given alias exist in the container?
     *
     * @param  string $id
     * @return bool
     */
    public function has($id) : bool
    {
        return array_key_exists($id, $this->definitions);
    }

    /**
     * With Arguments
     *
     * Pass arguments to a definition.
     *
     * @param  array $args
     * @return self
     */
    public function withArguments(array $args) : self
    {
        $this->arguments = $args;

        return $this;
    }
}