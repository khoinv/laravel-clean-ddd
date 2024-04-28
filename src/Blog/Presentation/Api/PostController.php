<?php

namespace Src\Blog\Presentation\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Src\Blog\Application\Payload\CreatePostPayload;
use Src\Blog\Application\Payload\FindPostPayload;
use Src\Blog\Application\Payload\GetPostsPayload;
use Src\Blog\Application\Payload\UpdatePostPayload;
use Src\Blog\Presentation\Api\ViewModel\PostViewModel;
use Src\Shared\Application\CommandBusInterface;
use Throwable;

class PostController extends Controller
{
    public function __construct(private CommandBusInterface $bus)
    {
    }

    /**
     * @throws Throwable
     */
    public function create(Request $request): JsonResponse
    {
        $postId = $this->bus->dispatch(new CreatePostPayload(
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
        $postId = $this->bus->dispatch(new UpdatePostPayload(
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
        $post = $this->bus->dispatch(new FindPostPayload($request->get('id')));

        return response()->json(['data' => PostViewModel::fromAggregate($post)]);
    }

    public function index(Request $request): JsonResponse
    {
        $posts = $this->bus->dispatch(new GetPostsPayload());

        return response()->json(['data' => ['posts' => array_map(fn($post) => PostViewModel::fromAggregate($post), $posts)]]);
    }
}
