<?php

declare(strict_types=1);

namespace JCombee\Reduced;

use JCombee\Reduced\Contracts\State;

abstract class StateAbstract implements State
{
    public function clone(...$args): static {
        $reflection = new \ReflectionClass($this);
        $parameters = $reflection->getConstructor()->getParameters();
        $newArgs=[];
        foreach ($parameters as $parameter) {
            $key = $parameter->getName();
            $newArgs[] = $args[$key] ?? $this->{$key};
        }
        return new (static::class)(...$newArgs);
    }
}
