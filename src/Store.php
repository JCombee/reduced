<?php

declare(strict_types=1);

namespace JCombee\Reduced;

use JCombee\Reduced\Contracts\Action;
use JCombee\Reduced\Contracts\Reducer;
use JCombee\Reduced\Contracts\State;

class Store
{
    private array $reducers = [];
    private array $subscibers = [];

    public function __construct(private State $state)
    {
    }

    public function registerReducer(Reducer $reducer): void
    {
        $this->reducers[] = $reducer;
    }

    public function dispatch(Action $action): void
    {
        $this->state = array_reduce($this->reducers, function (State $state, Reducer $reducer) use ($action) {
            return $reducer->reduce($state, $action);
        }, $this->state);

        foreach ($this->subscibers as $subscriber) {
            $subscriber($this->state);
        }
    }

    public function getState(): State
    {
        return $this->state;
    }

    public function subscribe(callable $callback): void
    {
        $this->subscibers[] = $callback;
    }

    public function unsubscribe(callable $unsubCallback)
    {
        $this->subscibers = array_filter($this->subscibers, fn($callback) => $unsubCallback !== $callback);
    }
}
