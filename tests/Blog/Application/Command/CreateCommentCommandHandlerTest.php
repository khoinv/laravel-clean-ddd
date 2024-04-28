<?php

namespace Tests\Blog\Application\Command;

use Illuminate\Contracts\Container\BindingResolutionException;
use Src\Blog\Application\Payload\CreateCommentPayload;
use Src\Blog\Application\Payload\CreatePostPayload;
use Src\Shared\Application\CommandBusInterface;
use Tests\TestCase;
use Throwable;

class CreateCommentCommandHandlerTest extends TestCase
{
    /**
     * @throws Throwable
     * @throws BindingResolutionException
     */
    public function testProcess()
    {
        $bus = app()->make(CommandBusInterface::class);

        $postId = $bus->dispatch(new CreatePostPayload(
            title: 'a-title ' . time() . rand(1, 10000000),
            slug: null,
            content: 'A content'
        ));

        $bus->dispatch(
            new CreateCommentPayload(
                $postId,
                "Just a comment 1"
            )
        );

        $bus->dispatch(
            new CreateCommentPayload(
                $postId,
                "Just a comment 2"
            )
        );

        // TODO: add assert
        $this->assertTrue(true);
    }
}
