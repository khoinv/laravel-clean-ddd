<?php

namespace Src\Blog\Application\Payload;

class FindPostPayload
{
    public function __construct(public int $postId) { }
}
