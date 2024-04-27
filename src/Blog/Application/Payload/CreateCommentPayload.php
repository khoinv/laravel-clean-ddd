<?php

namespace Src\Blog\Application\Payload;

class CreateCommentPayload
{
    public function __construct(public int $postId, public ?string $content) { }
}
