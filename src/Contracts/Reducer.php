<?php

declare(strict_types=1);

namespace JCombee\Reduced\Contracts;

interface Reducer
{
    public function reduce(State $state, Action $action): State;
}
