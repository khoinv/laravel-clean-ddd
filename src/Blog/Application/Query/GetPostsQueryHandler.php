<?php

namespace Src\Blog\Application\Query;

use Src\Blog\Domain\Aggregate\PostAggregate;
use Src\Blog\Infrastructure\Repository\Mysql\PostQueryRepository;

readonly class GetPostsQuery
{
    public function __construct(private PostQueryRepository $postRepository)
    {
    }

    /**
     * @return PostAggregate[]
     */
    public function process(): array
    {
        return $this->postRepository->get();
    }
}
