<?php

namespace Src\Blog\Application\Payload;

class UpdateCommentPayload
{
    public function __construct(public int $postId, public int $id, public ?string $content) { }
}
