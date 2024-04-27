<?php

namespace Src\Blog\Domain\ValueObject;

use Src\Shared\Domain\ValueObject\IntValue;

class PostId extends IntValue
{
    public function __construct(int $value = null, int $min = 0) { parent::__construct($value, $min); }
}
