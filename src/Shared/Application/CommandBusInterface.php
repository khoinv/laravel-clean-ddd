<?php

namespace Src\Shared\Application;

interface CommandBusInterface
{
    public function dispatch($command): mixed;

    public function map(array $map): mixed;
}
