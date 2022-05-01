<?php

declare(strict_types=1);

namespace JCombee\Reduced\Tests\Example\Actions;

use JCombee\Reduced\Contracts\Action;
use JCombee\Reduced\Tests\Example\Enums\DirectionEnum;

class MovementAction implements Action
{
    public function __construct(public readonly DirectionEnum $direction)
    {
    }
}
