<?php

namespace Src\Blog\Application\Query;

use Src\Blog\Application\Payload\FindPostPayload;
use Src\Blog\Domain\Aggregate\PostAggregate;
use Src\Blog\Infrastructure\Repository\Mysql\PostQueryRepository;

class FindPostQueryHandler
{
    public function __construct(private PostQueryRepository $postRepository)
    {
    }

    public function handle(FindPostPayload $payload): PostAggregate
    {
        return $this->postRepository->findOrFail($payload->postId);
    }
}
