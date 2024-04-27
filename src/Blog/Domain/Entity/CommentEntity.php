<?php

namespace Src\Blog\Domain\Entity;

use Src\Blog\Domain\ValueObject\CommentContent;
use Src\Blog\Domain\ValueObject\CommentId;
use Src\Shared\Domain\Entity\HasKeyInterface;

class CommentEntity implements HasKeyInterface
{
    public function __construct(private CommentId $id, private CommentContent $content) { }

    public function getKey(): int|string|null
    {
        return $this->getId()?->getValue();
    }

    public function getId(): CommentId
    {
        return $this->id;
    }

    public function setId(CommentId $id): void
    {
        $this->id = $id;
    }

    public function getContent(): CommentContent
    {
        return $this->content;
    }

    public function setContent(CommentContent $content): void
    {
        $this->content = $content;
    }
}
