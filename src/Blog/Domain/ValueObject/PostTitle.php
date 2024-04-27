<?php

namespace Src\Blog\Domain\ValueObject;

use Src\Shared\Domain\ValueObject\StringValue;

class PostTitle extends StringValue
{
    public function __construct(?string $value = null, ?int $limit = 255) { parent::__construct($value, $limit); }
}
