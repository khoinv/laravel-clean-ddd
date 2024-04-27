<?php

namespace Src\Blog\Domain\Aggregate;

use Exception;
use Src\Blog\Domain\Entity\CommentEntity;
use Src\Blog\Domain\ValueObject\PostContent;
use Src\Blog\Domain\ValueObject\PostId;
use Src\Blog\Domain\ValueObject\PostSlug;
use Src\Blog\Domain\ValueObject\PostTitle;
use Src\Shared\Slug;
use Throwable;

class PostAggregate
{
    private CommentCollection $comments;

    /**
     * @throws Throwable
     */
    public function __construct(private PostId $id, private PostSlug $slug, private PostTitle $title, private PostContent $content)
    {
        $this->comments = new CommentCollection();
        $this->createSlugFromTitle();
    }

    /**
     * @throws Throwable
     */
    private function createSlugFromTitle(): void
    {
        if (!$this->slug->getValue() && $this->title->getValue()) {
            $this->setSlug(new PostSlug(Slug::slugify($this->title->getValue())));
        }
    }

    public function setSlug(PostSlug $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function setId(PostId $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getSlug(): PostSlug
    {
        return $this->slug;
    }

    public function getTitle(): PostTitle
    {
        return $this->title;
    }

    /**
     * @throws Throwable
     */
    public function setTitle(PostTitle $title): self
    {
        $this->title = $title;
        $this->createSlugFromTitle();

        return $this;
    }

    public function getContent(): PostContent
    {
        return $this->content;
    }

    public function setContent(PostContent $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getKey(): string|int|null
    {
        return $this->getId()->getValue();
    }

    public function getId(): PostId
    {
        return $this->id;
    }

    public function addComment(CommentEntity $commentEntity): static
    {
        $this->comments->addItems($commentEntity);

        return $this;
    }

    /**
     * @throws Throwable
     */
    public function deleteComment(CommentEntity $comment): static
    {
        $this->comments->deleteItems($comment);

        return $this;
    }

    /**
     * @throws Throwable
     */
    public function updateComment(CommentEntity $comment): static
    {
        $this->comments->updateItems($comment);

        return $this;
    }

    /**
     * @return CommentEntity[]
     */
    public function getComments(): array
    {
        return $this->comments->getItems();
    }

    /**
     * @throws Exception
     */
    public function findComment(mixed $key): CommentEntity
    {
        return $this->comments->findItem($key);
    }
}
