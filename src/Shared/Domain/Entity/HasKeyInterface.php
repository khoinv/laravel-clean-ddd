<?php

namespace Src\Shared\Domain\Entity;

interface HasKeyInterface
{
    public function getKey(): string|int|null;
}
