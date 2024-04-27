<?php

namespace Src\Blog\Domain\Aggregate;

use Src\Blog\Domain\Entity\CommentEntity;
use Src\Shared\Domain\ValueObject\KeyValueCollection;

class CommentCollection extends KeyValueCollection
{
    /**
     * @template T as CommentEntity
     * @param CommentEntity[] $items
     */
    public function __construct(array $items = []) { parent::__construct($items); }
}
