<?php

namespace Src\Blog\Application\Repository;


use Src\Blog\Domain\Aggregate\PostAggregate;

interface PostWriteInterfaceRepository
{
    public function save(PostAggregate $postAggregate): int;
}
