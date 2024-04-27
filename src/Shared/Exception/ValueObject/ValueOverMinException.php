<?php

namespace Src\Shared\Exception\ValueObject;

use Src\Shared\Exception\DomainException;

class ValueOverMinException extends DomainException
{
    public function __construct(public $message = "Over min value", public $min = 1000)
    {
        parent::__construct($this->message);
    }
}
