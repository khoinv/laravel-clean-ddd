<?php

namespace Src\Shared\Domain\ValueObject;

use Src\Shared\Exception\ExceptionUtil;
use Src\Shared\Exception\ValueObject\NumberOverMaxException;
use Src\Shared\Exception\ValueObject\NumberOverMinException;
use Throwable;

class IntValue
{

    /**
     * @throws Throwable
     */
    public function __construct(private ?int $value, private readonly ?int $min = 0, private readonly ?int $max = null)
    {
        ExceptionUtil::throw_if(is_int($this->value) && is_int($min) && $this->value < $min, new NumberOverMinException(min: $min));
        ExceptionUtil::throw_if(is_int($this->value) && is_int($max) && $this->value > $max, new NumberOverMaxException(max: $max));
    }

    public function getValue(): ?int
    {
        return $this->value;
    }

    public function setValue(?string $value): void
    {
        $this->value = $value;
    }

    public function getMin(): ?int
    {
        return $this->min;
    }

    public function getMax(): ?int
    {
        return $this->max;
    }


}
