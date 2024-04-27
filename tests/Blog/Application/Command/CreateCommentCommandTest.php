<?php

namespace Tests\Blog\Application\Command;

use Illuminate\Contracts\Container\BindingResolutionException;
use Src\Blog\Application\Command\CreateCommentCommand;
use Src\Blog\Application\Command\CreatePostCommand;
use Src\Blog\Application\Payload\CreateCommentPayload;
use Src\Blog\Application\Payload\CreatePostPayload;
use Src\Blog\Infrastructure\Repository\Mysql\PostQueryRepository;
use Tests\TestCase;
use Throwable;

class CreateCommentCommandTest extends TestCase
{
    private CreatePostCommand $createPostCommand;
    private CreateCommentCommand $createCommentCommand;

    /**
     * @throws Throwable
     * @throws BindingResolutionException
     */
    public function testProcess()
    {
        $this->createPostCommand = app()->make(CreatePostCommand::class);
        $this->createCommentCommand = app()->make(CreateCommentCommand::class);

        $repository = app()->make(PostQueryRepository::class);
        $postId = $this->createPostCommand->process(new CreatePostPayload(
            title: 'a-title ' . time() . rand(1, 10000000),
            slug: null,
            content: 'A content'
        ));

        $this->createCommentCommand->process(
            new CreateCommentPayload(
                $postId,
                "Just a comment 1"
            )
        );

        $this->createCommentCommand->process(
            new CreateCommentPayload(
                $postId,
                "Just a comment 2"
            )
        );

        // TODO: add assert
        $this->assertTrue(true);
    }
}
