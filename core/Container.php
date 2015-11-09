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
    /** @var array $dependencies List of dependencies **/
    private $dependencies = [];

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

        $this->dependencies = $this->getDependencies($parameters);

        if (!empty($args))
        {
            $this->addArgs($args);
        }

        $this->instances[$class] = $resolver->newInstanceArgs($this->dependencies);

        return $this->instances[$class];
    }

    /**
     * Build up a list of dependencies for a given methods parameters
     * @param array $parameters
     * @return array
     */
    public function getDependencies($parameters)
    {

        foreach ($parameters as $parameter) {
            $dependency = $parameter->getClass();

            if ($dependency == null)
            {
                $this->dependencies[] = $this->resolveNonClass($parameter);
                continue;
            } 
            
            $this->dependencies[] = $this->resolve($dependency->name);
        }
        return $this->dependencies;
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
    
    /**
     * Compute given dependency arguments
     * @param array $args Arguments Array
     * @return array $dependencies
     */
     public function getArgs(array $args)
     {
         foreach ($args as $key => $value) {
             $this->dependencies[$key] = $value;
         }
         
         return $this->dependencies;
     }
}