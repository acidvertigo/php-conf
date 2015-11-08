<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Acd;

/**
 * IOC Container class
 *
 * @author Acidvertigo
 */
class Container
{

    /** @var array $instances List of class instances **/
    private $instances = [];

    /**
     * Build an instance of the given class
     * @param string $class
     * @param array $args
     * @param bool $shared
     * @return object
     * @throws \Exception
     */
    public function resolve($class, array $args = [], $shared = TRUE)
    {
        //If $shared is true then return same instance.
        if ($shared !== FALSE && isset($this->instances[$class]))
        {
            return $this->instances[$class];
        }

        $resolver = new \ReflectionClass($class);

        if (!$resolver->isInstantiable())
        {
            throw new \Exception($class . ' is not instantiable');
        }
 
        $constructor = $resolver->getConstructor();

        if (!$constructor)
        {
            return new $class;
        }

        $parameters = $constructor->getParameters();

        if (empty($parameters))
        {
            return new $class;
        }

        $dependencies = $this->getDependencies($parameters);

        if (!empty($args))
        {
            foreach ($args as $key => $value) {
                $dependencies[$key] = $value;
            }
        }

        $this->instances[$class] = $resolver->newInstanceArgs($dependencies);

        return $this->instances[$class];
    }

    /**
     * Build up a list of dependencies for a given methods parameters
     * @param array $parameters
     * @return array
     */
    public function getDependencies($parameters)
    {
        $dependencies = [];

        foreach ($parameters as $parameter) {
            $dependency = $parameter->getClass();

            if (is_null($dependency))
            {
                $dependencies[] = $this->resolveNonClass($parameter);
                continue;
            } 
            
            $dependencies[] = $this->resolve($dependency->name);
        }
        return $dependencies;
    }

    /**
     * Determine what to do with a non-class value
     *
     * @param \ReflectionParameter $parameter
     * @return mixed
     *
     * @throws Exception
     */
    public function resolveNonClass(\ReflectionParameter $parameter)
    {
        if ($parameter->isDefaultValueAvailable())
        {
            return $parameter->getDefaultValue();
        }

    }
}