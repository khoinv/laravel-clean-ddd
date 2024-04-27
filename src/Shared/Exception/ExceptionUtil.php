<?php

namespace Src\Shared\Exception;

use Throwable;

class ExceptionUtil
{
    /**
     * @throws Throwable
     */
    static public function throw(Throwable $exception)
    {
        throw $exception;
    }

    /**
     * @throws Throwable
     */
    static public function throw_if(bool $cond, Throwable $exception): void
    {
        if ($cond) {
            throw $exception;
        }
    }
}
