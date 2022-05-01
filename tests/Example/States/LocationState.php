<?php

declare(strict_types=1);

namespace JCombee\Reduced\Tests\Example\States;

use JCombee\Reduced\StateAbstract;

class LocationState extends StateAbstract
{
    public function __construct(public readonly int $x, public readonly int $y)
    {
    }
}
