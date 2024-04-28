<?php

namespace Src\Shared;

use Carbon\Laravel\ServiceProvider;
use Src\Shared\Application\CommandBusInterface;
use Src\Shared\Infrastructure\CommandBus;

class SharedProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(CommandBusInterface::class, CommandBus::class);
    }
}
