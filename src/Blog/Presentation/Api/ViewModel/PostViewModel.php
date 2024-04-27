<?php

namespace Src\Blog\Presentation\Api\ViewModel;

use Src\Blog\Domain\Aggregate\PostAggregate;

readonly class PostViewModel
{
    public function __construct(
        private int    $id,
        private string $title,
        private string $content,
        private array  $comments
    )
    {
    }

    static function fromAggregate(PostAggregate $postAggregate): self
    {
        return new self(
            $postAggregate->getId()->getValue(),
            $postAggregate->getTitle()->getValue(),
            $postAggregate->getContent()->getValue(),
            array_map(fn($comment) => CommentViewModel::fromEntity($comment), $postAggregate->getComments())
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'content' => $this->content,
            'comments' => $this->comments,
        ];
    }
}
