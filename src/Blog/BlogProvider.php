<?php

namespace Src\Blog;

use Carbon\Laravel\ServiceProvider;
use Src\Blog\Application\Command\CreateCommentCommandHandler;
use Src\Blog\Application\Command\CreatePostCommandHandler;
use Src\Blog\Application\Command\UpdateCommentCommandHandler;
use Src\Blog\Application\Command\UpdatePostCommandHandler;
use Src\Blog\Application\Payload\CreateCommentPayload;
use Src\Blog\Application\Payload\CreatePostPayload;
use Src\Blog\Application\Payload\FindPostPayload;
use Src\Blog\Application\Payload\GetPostsPayload;
use Src\Blog\Application\Payload\UpdateCommentPayload;
use Src\Blog\Application\Payload\UpdatePostPayload;
use Src\Blog\Application\Query\FindPostQueryHandler;
use Src\Blog\Application\Query\GetPostsQueryHandler;
use Src\Blog\Application\Repository\PostQueryInterfaceRepository;
use Src\Blog\Application\Repository\PostWriteInterfaceRepository;
use Src\Blog\Infrastructure\Repository\Mysql\PostQueryRepository;
use Src\Blog\Infrastructure\Repository\Mysql\PostWriteRepository;
use Src\Shared\Application\CommandBusInterface;

class BlogProvider extends ServiceProvider
{
    public function register()
    {
        app()->bind(PostQueryInterfaceRepository::class, PostQueryRepository::class);
        app()->bind(PostWriteInterfaceRepository::class, PostWriteRepository::class);

        $bus = app()->make(CommandBusInterface::class);
        $bus->map([
            CreateCommentPayload::class => CreateCommentCommandHandler::class,
            CreatePostPayload::class => CreatePostCommandHandler::class,
            UpdatePostPayload::class => UpdatePostCommandHandler::class,
            UpdateCommentPayload::class => UpdateCommentCommandHandler::class,

            FindPostPayload::class => FindPostQueryHandler::class,
            GetPostsPayload::class => GetPostsQueryHandler::class,
        ]);
    }
}
