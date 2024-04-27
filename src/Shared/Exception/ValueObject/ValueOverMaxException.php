<?php

namespace Src\Shared\Exception\ValueObject;

use Src\Shared\Exception\DomainException;

class ValueOverMaxException extends DomainException
{
    public function __construct(public $message = "Over max value", public $max = 1000)
    {
        parent::__construct($this->message);
    }
}
