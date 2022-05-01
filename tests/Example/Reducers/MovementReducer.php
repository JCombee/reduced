<?php

declare(strict_types=1);

namespace JCombee\Reduced\Tests\Example\Reducers;

use JCombee\Reduced\Contracts\Action;
use JCombee\Reduced\Contracts\Reducer;
use JCombee\Reduced\Contracts\State;
use JCombee\Reduced\Tests\Example\Actions\MovementAction;
use JCombee\Reduced\Tests\Example\Enums\DirectionEnum;
use JCombee\Reduced\Tests\Example\States\LocationState;
use JetBrains\PhpStorm\Pure;

class MovementReducer implements Reducer
{
    #[Pure] public function reduce(LocationState|State $state, MovementAction|Action $action): LocationState
    {
        return match ($action->direction) {
            DirectionEnum::UP => $this->moveUp($state),
            DirectionEnum::DOWN => $this->moveDown($state),
            DirectionEnum::LEFT => $this->moveLeft($state),
            DirectionEnum::RIGHT => $this->moveRight($state),
        };
    }

    private function moveUp(LocationState $state): LocationState
    {
        return $state->clone(y: $state->y - 1);
    }

    private function moveDown(LocationState $state): LocationState
    {
        return $state->clone(y: $state->y + 1);
    }

    private function moveLeft(LocationState $state): LocationState
    {
        return $state->clone(x: $state->x - 1);
    }

    private function moveRight(LocationState $state): LocationState
    {
        return $state->clone(x: $state->x + 1);
    }
}
