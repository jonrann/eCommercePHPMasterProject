<?php

declare(strict_types=1);

namespace Framework;

use ReflectionClass, ReflectionNamedType;
use Framework\Exceptions\ContainerException;

class Container
{
    private array $definitions = [];

    public function addDefinitions(array $newDefinitions)
    {
        // ... operator unpacks an array
        $this->definitions = [...$this->definitions, ...$newDefinitions];
    }

    public function resolve(string $className)
    {
        // returns information related to the class
        $reflectionClass = new ReflectionClass($className);

        if  (!$reflectionClass->isInstantiable()) 
        {
            throw new ContainerException("Class $className is not instantiable");
        }

        $constructor = $reflectionClass->getConstructor();

        if (!$constructor)
        {
            return new $className;
        }

        $parameters = $constructor->getParameters();
        if (count($parameters) === 0)
        {
            return new $className;
        }

        $dependencies = [];

        foreach ($parameters as $param)
        {
            $name = $param->getName();
            $type = $param->getType();

            if (!$type)
            {
                throw new ContainerException("Failed to resolve class $className because param $name is missing a type hint.");
            }

            if (!$type instanceof ReflectionNamedType || $type->isBuiltin())
            {
                throw new ContainerException("ailed to resolve class $className because invalid parameter name.");
            }

            $dependencies[] = $this->get($type->getName());
        }

        return $reflectionClass->newInstanceArgs($dependencies);
    }
    public function get(string $id)
    {
        if (!array_key_exists($id, $this->definitions))
        {
            throw new ContainerException("Class $id does not exist in container.");
        }

        $factory = $this->definitions[$id];

        $depedency = $factory();

        return $depedency;
    }
}