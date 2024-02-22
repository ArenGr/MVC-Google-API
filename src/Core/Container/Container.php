<?php

namespace App\Core\Container;

use Closure;
use Exception;
use ReflectionClass;
use Psr\Container\ContainerInterface;

class Container implements ContainerInterface
{
    protected array $instances = [];

    public function get($id, $parameters = [])
    {
        if (!$this->has($id)) {
            $this->set($id);
        }

        return $this->resolve($this->instances[$id], $parameters);
    }

    public function has($id): bool
    {
        return isset($this->instances[$id]);
    }

    public function set($abstract, $concrete = null)
    {
        if ($concrete === null) {
            $concrete = $abstract;
        }

        if (!$this->has($abstract)) {
            $this->instances[$abstract] = $concrete;
        }
    }

    public function resolve($concrete, $parameters)
    {
        if ($concrete instanceof Closure) {
            return $concrete($this, $parameters);
        }

        $reflector = new ReflectionClass($concrete);
        if (!$reflector->isInstantiable()) {
            throw new Exception("Class {$concrete} is not instantiable");
        }

        $constructor = $reflector->getConstructor();
        if ($constructor === null) {
            return $reflector->newInstance();
        }

        $parameters = $constructor->getParameters();
        $dependencies = $this->getDependencies($parameters);

        return $reflector->newInstanceArgs($dependencies);
    }

    public function getDependencies($parameters)
    {
        $dependencies = [];
        foreach ($parameters as $parameter) {
            $dependency = $parameter->getClass();
            if ($dependency === null) {
                if ($parameter->isDefaultValueAvailable()) {
                    $dependencies[] = $parameter->getDefaultValue();
                } else {
                    throw new Exception("Cannot resolve class dependency {$parameter->name}");
                }
            } else {
                $dependencies[] = $this->get($dependency->name);
            }
        }
        return $dependencies;
    }
}
