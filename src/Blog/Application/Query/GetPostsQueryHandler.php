<?php

namespace Src\Blog\Application\Query;

use Src\Blog\Application\Payload\GetPostsPayload;
use Src\Blog\Domain\Aggregate\PostAggregate;
use Src\Blog\Infrastructure\Repository\Mysql\PostQueryRepository;

readonly class GetPostsQueryHandler
{
    public function __construct(private PostQueryRepository $postRepository)
    {
    }

    /**
     * @return PostAggregate[]
     */
    public function handle(GetPostsPayload $payload): array
    {
        return $this->postRepository->get();
    }
}
