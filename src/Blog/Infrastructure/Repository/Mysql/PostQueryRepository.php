<?php

namespace Src\Blog\Infrastructure\Repository\Mysql;

use Illuminate\Database\Eloquent\Builder;
use Src\Blog\Application\Repository\PostQueryInterfaceRepository;
use Src\Blog\Domain\Aggregate\PostAggregate;
use Src\Blog\Domain\Entity\CommentEntity;
use Src\Blog\Domain\ValueObject\CommentContent;
use Src\Blog\Domain\ValueObject\CommentId;
use Src\Blog\Domain\ValueObject\PostContent;
use Src\Blog\Domain\ValueObject\PostId;
use Src\Blog\Domain\ValueObject\PostSlug;
use Src\Blog\Domain\ValueObject\PostTitle;
use Src\Blog\Infrastructure\Model\Post;
use Throwable;

class PostQueryRepository implements PostQueryInterfaceRepository
{
    public function findOrFail(int $postId): PostAggregate
    {
        $post = $this->getQuery()->findOrFail($postId);
        $postAggregate = $this->toAggregate($post);

        return $postAggregate;
    }

    /**
     * TODO: separate connection for read only query.
     * @return Post|Builder
     */
    private function getQuery(): Post|Builder
    {
        return Post::query();
    }

    /**
     * @param Post $post
     * @return PostAggregate
     * @throws Throwable
     */
    private function toAggregate(Post $post): PostAggregate
    {
        $postAggregate = new PostAggregate(
            new PostId($post->id),
            new PostSlug($post->slug),
            new PostTitle($post->title),
            new PostContent($post->content)
        );

        foreach ($post->comments as $comment) {
            $postAggregate->addComment(new CommentEntity(
                new CommentId($comment->id),
                new CommentContent($comment->content)
            ));
        }

        return $postAggregate;
    }

    public function isSlugExists(?string $slug, ?int $ignoreId = null): bool
    {
        return $this->getQuery()->whereSlug($slug)->whereNot('id', $ignoreId)->exists();
    }

    public function get(): array
    {
        $posts = $this->getQuery()->all();

        return $posts->map(fn(Post $post) => $this->toAggregate($post));
    }
}
