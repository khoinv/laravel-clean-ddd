<?php

namespace Src\Blog\Application\Query;

use Src\Blog\Domain\Aggregate\PostAggregate;
use Src\Blog\Infrastructure\Repository\Mysql\PostQueryRepository;

class FindPostQuery
{
    public function __construct(private PostQueryRepository $postRepository)
    {
    }

    public function process(int $postId): PostAggregate
    {
        return $this->postRepository->findOrFail($postId);
    }
}
