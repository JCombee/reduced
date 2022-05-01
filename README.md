Reduced
=======
A state management library for PHP.

## Content

- [Instalation](#instalation)
- [How to use](#how-to-use)

## Instalation

```bash

composer require jcombee/reduced

```

## How to use

This example bellow uses the classes in: [tests/Example](tests/Example).

```php

    $state = new LocationState(0, 0);
    $store = new Store($state);

    $store->subscribe(function (LocationState $state) {
        echo "Location: {$state->x}, {$state->y}";
    });

    $store->registerReducer(new MovementReducer());

    $store->dispatch(new MovementAction(DirectionEnum::UP));
    $store->dispatch(new MovementAction(DirectionEnum::LEFT))
    $store->dispatch(new MovementAction(DirectionEnum::DOWN))
    $store->dispatch(new MovementAction(DirectionEnum::RIGHT))

    $state = $store->getState();

    /**
     * Location: 0, -1
     * Location: -1, -1
     * Location: -1, 0
     * Location: 0, 0
     */

```
