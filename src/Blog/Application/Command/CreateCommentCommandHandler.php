<?php

namespace Src\Blog\Application\Command;


use Src\Blog\Application\Payload\CreateCommentPayload;
use Src\Blog\Application\Repository\PostQueryInterfaceRepository;
use Src\Blog\Application\Repository\PostWriteInterfaceRepository;
use Src\Blog\Domain\Entity\CommentEntity;
use Src\Blog\Domain\ValueObject\CommentContent;
use Src\Blog\Domain\ValueObject\CommentId;
use Throwable;

readonly class CreateCommentHandler
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
    public function handle(CreateCommentPayload $payload): int
    {
        $postAggregate = $this->queryRepository->findOrFail($payload->postId);
        $comment = new CommentEntity(new CommentId(), new CommentContent($payload->content));
        $postAggregate->addComment($comment);

        return $this->writeRepository->save($postAggregate);
    }
}
