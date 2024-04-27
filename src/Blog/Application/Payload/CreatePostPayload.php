<?php

namespace Src\Blog\Application\Payload;

class CreatePostPayload
{
    public function __construct(public ?string $title, public ?string $slug, public ?string $content) { }
}
