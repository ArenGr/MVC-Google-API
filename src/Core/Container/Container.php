<?php

namespace App\Core\Container;

use Closure;
use Exception;
use ReflectionClass;

use Psr\Container\ContainerInterface;

class Container implements ContainerInterface
{
    /**
     * @var array
     */
    protected $instances = [];

    /**
     * @param       $id
     * @param array $parameters
     *
     * @return mixed|null|object
     * @throws Exception
     */
    public function get($id, $parameters = [])
    {
        if (!$this->has($id)) {
            $this->set($id);
        }

        return $this->resolve($this->instances[$id], $parameters);
    }


    /**
     * @param       $id
     *
     * @return bool
     * @throws Exception
     */
    public function has($id): bool
    {
        return isset($this->instances[$id]);
    }

    /**
     * @param      $abstract
     * @param null $concrete
     */
    public function set($abstract, $concrete = NULL)
    {
        if ($concrete === NULL) {
            $concrete = $abstract;
        }
        $this->instances[$abstract] = $concrete;
    }

    /**
     * resolve single
     *
     * @param $concrete
     * @param $parameters
     *
     * @return mixed|object
     * @throws Exception
     */
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
        if (is_null($constructor)) {
            return $reflector->newInstance();
        }

        $parameters = $constructor->getParameters();
        $dependencies = $this->getDependencies($parameters);

        return $reflector->newInstanceArgs($dependencies);
    }

    /**
     * get all dependencies resolved
     *
     * @param $parameters
     *
     * @return array
     * @throws Exception
     */
    public function getDependencies($parameters)
    {
        $dependencies = [];
        foreach ($parameters as $parameter) {
            $dependency = $parameter->getClass();
            if ($dependency === NULL) {
                if ($parameter->isDefaultValueAvailable()) {
                    $dependencies[] = $parameter->getDefaultValue();
                } else {
                    throw new Exception("Can not resolve class dependency {$parameter->name}");
                }
            } else {
                $dependencies[] = $this->get($dependency->name);
            }
        }
        return $dependencies;
    }
}
