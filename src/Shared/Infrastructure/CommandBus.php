<?php

namespace Src\Shared\Infrastructure;

use Illuminate\Bus\Dispatcher;
use Src\Shared\Application\CommandBusInterface;

class CommandBus implements CommandBusInterface
{
    public function __construct(private Dispatcher $bus) { }

    public function dispatch($command): mixed
    {
        return $this->bus->dispatch($command);
    }

    public function map(array $map): Dispatcher
    {
        return $this->bus->map($map);
    }
}
