<?php

namespace Src\Blog\Presentation\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Src\Blog\Application\Command\CreatePostCommand;
use Src\Blog\Application\Command\UpdatePostCommand;
use Src\Blog\Application\Payload\CreatePostPayload;
use Src\Blog\Application\Payload\UpdatePostPayload;
use Src\Blog\Application\Query\FindPostQuery;
use Src\Blog\Application\Query\GetPostsQuery;
use Src\Blog\Presentation\Api\ViewModel\PostViewModel;
use Throwable;

class PostController extends Controller
{
    public function __construct(
        private readonly CreatePostCommand $createPostCommand,
        private readonly UpdatePostCommand $updatePostCommand,
        private readonly FindPostQuery     $findPostQuery,
        private readonly GetPostsQuery     $getPostsQuery,
    )
    {
    }

    /**
     * @throws Throwable
     */
    public function create(Request $request): JsonResponse
    {
        $postId = $this->createPostCommand->process(
            new CreatePostPayload(
                $request->get('title'),
                $request->get('slug'),
                $request->get('content')
            )
        );

        return response()->json(['data' => ['id' => $postId]]);
    }

    /**
     * @throws Throwable
     */
    public function update(Request $request, int $postId): JsonResponse
    {
        $postId = $this->updatePostCommand->process(
            new UpdatePostPayload(
                $postId,
                $request->get('title'),
                $request->get('slug'),
                $request->get('content')
            )
        );

        return response()->json(['data' => ['id' => $postId]]);
    }

    public function show(Request $request): JsonResponse
    {
        $post = $this->findPostQuery->process($request->get('id'));

        return response()->json(['data' => PostViewModel::fromAggregate($post)]);
    }

    public function index(Request $request): JsonResponse
    {
        $posts = $this->getPostsQuery->process();

        return response()->json(['data' => ['posts' => array_map(fn($post) => PostViewModel::fromAggregate($post), $posts)]]);
    }
}
