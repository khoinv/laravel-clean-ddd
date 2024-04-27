<?php

namespace Src\Blog\Application\Repository;


use Src\Blog\Domain\Aggregate\PostAggregate;

interface PostQueryInterfaceRepository
{
    /**
     * @return PostAggregate[]
     */
    public function get(): array;

    public function isSlugExists(?string $slug): bool;
}
