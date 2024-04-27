<?php

namespace Src\Blog;

use Carbon\Laravel\ServiceProvider;
use Src\Blog\Application\Repository\PostQueryInterfaceRepository;
use Src\Blog\Application\Repository\PostWriteInterfaceRepository;
use Src\Blog\Infrastructure\Repository\Mysql\PostQueryRepository;
use Src\Blog\Infrastructure\Repository\Mysql\PostWriteRepository;

class BlogProvider extends ServiceProvider
{
    public function register()
    {
        app()->bind(PostQueryInterfaceRepository::class, PostQueryRepository::class);
        app()->bind(PostWriteInterfaceRepository::class, PostWriteRepository::class);
    }
}
