<?php

namespace Src\Blog\Infrastructure\Repository\Mysql;

use Src\Blog\Application\Repository\PostWriteInterfaceRepository;
use Src\Blog\Domain\Aggregate\PostAggregate;
use Src\Blog\Domain\Entity\CommentEntity;
use Src\Blog\Infrastructure\Model\Comment;
use Src\Blog\Infrastructure\Model\Post;
use Src\Shared\Domain\Entity\HasKeyInterface;

class PostWriteRepository implements PostWriteInterfaceRepository
{
    public function save(PostAggregate $postAggregate): int
    {
        $post = new Post();
        if ($postAggregate->getKey()) {
            $post = Post::findOrFail($postAggregate->getKey());
        }

        $post->title = $postAggregate->getTitle()->getValue();
        $post->slug = $postAggregate->getSlug()->getValue();
        $post->content = $postAggregate->getContent()->getValue();
        $post->save();

        $this->updateComments($post, $postAggregate->getComments());

        return $post->id;
    }

    /**
     * @param Post $post
     * @param CommentEntity[] $commentEntities
     * @return void
     */
    private function updateComments(Post $post, array $commentEntities): void
    {
        $validCommentIds = array_map(fn(HasKeyInterface $item) => $item->getKey(), $commentEntities);
        $post->comments()->whereNotIn('id', $validCommentIds)->delete();

        // TODO: can bulk insert and update only changed records
        foreach ($commentEntities as $commentEntity) {
            $comment = new Comment();
            if ($commentEntity->getKey()) {
                $comment = Comment::findOrFail($commentEntity->getKey());
            }

            $comment->post_id = $post->getKey();
            $comment->content = $commentEntity->getContent()->getValue();
            $comment->save();
        }
    }
}
