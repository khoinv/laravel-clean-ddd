<?php

namespace Src\Blog\Domain\ValueObject;

use Src\Shared\Domain\ValueObject\StringValue;

class PostContent extends StringValue
{
    public function __construct(?string $value, ?int $limit = 1000) { parent::__construct($value, $limit); }
}
