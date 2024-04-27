<?php

namespace Src\Blog\Application\Payload;

class UpdatePostPayload
{
    public function __construct(public int $id, public ?string $title, public ?string $slug, public ?string $content) { }
}
