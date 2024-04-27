<?php

namespace Src\Blog\Application\Command;


use Src\Blog\Application\Payload\UpdateCommentPayload;
use Src\Blog\Application\Repository\PostQueryInterfaceRepository;
use Src\Blog\Application\Repository\PostWriteInterfaceRepository;
use Src\Blog\Domain\ValueObject\CommentContent;
use Throwable;

readonly class UpdateCommentHandler
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
    public function handle(UpdateCommentPayload $payload): int
    {
        $postAggregate = $this->queryRepository->findOrFail($payload->postId);
        $comment = $postAggregate->findComment($payload->id);
        $comment->setContent(new CommentContent($payload->content));
        $postAggregate->updateComment($comment);

        return $this->writeRepository->save($postAggregate);
    }
}
