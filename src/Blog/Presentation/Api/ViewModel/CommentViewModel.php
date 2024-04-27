<?php

namespace Src\Blog\Presentation\Api\ViewModel;


use Src\Blog\Domain\Entity\CommentEntity;

class CommentViewModel
{
    public function __construct(private readonly int $id, private readonly string $content) { }

    /**
     * @param CommentEntity $comment
     * @return CommentViewModel
     */
    public static function fromEntity(CommentEntity $comment): CommentViewModel
    {
        return new self($comment->getKey(), $comment->getContent()->getValue());
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'content' => $this->content,
        ];
    }
}
