<?php

namespace Src\Shared\Domain\ValueObject;

use Src\Shared\Exception\ExceptionUtil;
use Src\Shared\Exception\ValueObject\ValueToLongException;
use Throwable;

class StringValue
{

    /**
     * @throws Throwable
     */
    public function __construct(private ?string $value, private readonly ?int $limit = 1000)
    {
        ExceptionUtil::throw_if(is_string($this->value) && is_int($limit) && strlen($this->value) > $limit, new ValueToLongException(limit: $limit));
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(?string $value): void
    {
        $this->value = $value;
    }

    public function getLimit(): ?int
    {
        return $this->limit;
    }
}
