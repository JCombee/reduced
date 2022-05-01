<?php

declare(strict_types=1);

namespace JCombee\Reduced\Contracts;

interface State
{
    public function clone(...$args): static;
}
