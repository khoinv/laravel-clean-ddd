<?php

namespace Src\Blog\Application\Command;


use Src\Blog\Application\Exception\SlugAlreadyExistedException;
use Src\Blog\Application\Payload\CreatePostPayload;
use Src\Blog\Application\Repository\PostQueryInterfaceRepository;
use Src\Blog\Application\Repository\PostWriteInterfaceRepository;
use Src\Blog\Domain\Aggregate\PostAggregate;
use Src\Blog\Domain\ValueObject\PostContent;
use Src\Blog\Domain\ValueObject\PostId;
use Src\Blog\Domain\ValueObject\PostSlug;
use Src\Blog\Domain\ValueObject\PostTitle;
use Throwable;

readonly class CreatePostHandler
{
    public function __construct(
        private PostQueryInterfaceRepository $queryRepository,
        private PostWriteInterfaceRepository $writeRepository,
    )
    {
    }


    /**
     * @throws Throwable
     */
    public function handle(CreatePostPayload $payload): int
    {
        if ($this->queryRepository->isSlugExists($payload->slug)) {
            throw new SlugAlreadyExistedException();
        }

        $postAggregate = new PostAggregate(
            new PostId(),
            new PostSlug($payload->slug),
            new PostTitle($payload->title),
            new PostContent($payload->content)
        );

        return $this->writeRepository->save($postAggregate);
    }
}
