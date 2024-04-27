<?php

namespace Src\Shared\Exception\ValueObject;

use Src\Shared\Exception\DomainException;

class ValueToLongException extends DomainException
{
    public function __construct(public $message = "To long", public $limit = 1000)
    {
        parent::__construct($this->message);
    }
}
