<?php

namespace Src\Blog\Application\Command;


use Src\Blog\Application\Exception\SlugAlreadyExistedException;
use Src\Blog\Application\Payload\UpdatePostPayload;
use Src\Blog\Application\Repository\PostQueryInterfaceRepository;
use Src\Blog\Application\Repository\PostWriteInterfaceRepository;
use Src\Blog\Domain\ValueObject\PostContent;
use Src\Blog\Domain\ValueObject\PostSlug;
use Src\Blog\Domain\ValueObject\PostTitle;
use Throwable;

readonly class UpdatePostHandler
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
    public function handle(UpdatePostPayload $payload): int
    {
        if ($this->queryRepository->isSlugExists($payload->slug, $payload->id)) {
            throw new SlugAlreadyExistedException();
        }

        $postAggregate = $this->queryRepository->findOrFail($payload->id);
        $postAggregate->setSlug(new PostSlug($payload->slug));
        $postAggregate->setTitle(new PostTitle($payload->title));
        $postAggregate->setContent(new PostContent($payload->content));

        return $this->writeRepository->save($postAggregate);
    }
}
