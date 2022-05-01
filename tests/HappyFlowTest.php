<?php

use JCombee\Reduced\Store;
use JCombee\Reduced\Tests\Example\Actions\MovementAction;
use JCombee\Reduced\Tests\Example\Enums\DirectionEnum;
use JCombee\Reduced\Tests\Example\Reducers\MovementReducer;
use JCombee\Reduced\Tests\Example\States\LocationState;

test('example', function () {
    $state = new LocationState(0, 0);
    $store = new Store($state);

    $mock = mock(\stdClass::class);
    $mock->shouldReceive('call')->times(6);
    $mockedCallback = [$mock, 'call'];

    $store->subscribe($mockedCallback);

    $states = [
        ['x' => -2, 'y' => -2],
        ['x' => -2, 'y' => -1],
        ['x' => -3, 'y' => -1],
        ['x' => -2, 'y' => -1],
        ['x' => -1, 'y' => -1],
        ['x' => 0, 'y' => -1],
        ['x' => 0, 'y' => -2],
        ['x' => 0, 'y' => -1],
    ];
    $store->subscribe(function (LocationState $state) use (&$states) {
        $stateArr = array_pop($states);
        expect($state->x)->toBe($stateArr['x'])->and($state->y)->toBe($stateArr['y']);
    });

    $store->registerReducer(new MovementReducer());

    $store->dispatch(new MovementAction(DirectionEnum::UP));
    $store->dispatch(new MovementAction(DirectionEnum::UP));
    $store->dispatch(new MovementAction(DirectionEnum::DOWN));
    $store->dispatch(new MovementAction(DirectionEnum::LEFT));
    $store->dispatch(new MovementAction(DirectionEnum::LEFT));
    $store->dispatch(new MovementAction(DirectionEnum::LEFT));

    $store->unsubscribe($mockedCallback);

    $store->dispatch(new MovementAction(DirectionEnum::RIGHT));
    $store->dispatch(new MovementAction(DirectionEnum::UP));



    $state = $store->getState();

    expect($state->x)->toBe(-2)->and($state->y)->toBe(-2);
});
