## Laravel Clean Architecture and DDD example
This project is a simple demo applying the following technologies with Laravel
+ Clean Architecture
+ Domain Driven Design
+ Command Bus
+ CQRS

## Projects structures
```sh
├── Blog
│   ├── Application
│   │   ├── Command
│   │   │   ├── CreateCommentCommandHandler.php
│   │   │   ├── CreatePostCommandHandler.php
│   │   │   ├── UpdateCommentCommandHandler.php
│   │   │   └── UpdatePostCommandHandler.php
│   │   ├── Exception
│   │   │   └── SlugAlreadyExistedException.php
│   │   ├── Payload
│   │   │   ├── CreateCommentPayload.php
│   │   │   ├── CreatePostPayload.php
│   │   │   ├── FindPostPayload.php
│   │   │   ├── GetPostsPayload.php
│   │   │   ├── UpdateCommentPayload.php
│   │   │   └── UpdatePostPayload.php
│   │   ├── Query
│   │   │   ├── FindPostQueryHandler.php
│   │   │   └── GetPostsQueryHandler.php
│   │   └── Repository
│   │       ├── PostQueryInterfaceRepository.php
│   │       └── PostWriteInterfaceRepository.php
│   ├── BlogProvider.php
│   ├── Domain
│   │   ├── Aggregate
│   │   │   ├── CommentCollection.php
│   │   │   └── PostAggregate.php
│   │   ├── Entity
│   │   │   └── CommentEntity.php
│   │   └── ValueObject
│   │       ├── CommentContent.php
│   │       ├── CommentId.php
│   │       ├── PostContent.php
│   │       ├── PostId.php
│   │       ├── PostSlug.php
│   │       └── PostTitle.php
│   ├── Infrastructure
│   │   ├── Model
│   │   │   ├── Comment.php
│   │   │   └── Post.php
│   │   └── Repository
│   │       └── Mysql
│   │           ├── PostQueryRepository.php
│   │           └── PostWriteRepository.php
│   └── Presentation
│       ├── Api
│       │   ├── PostController.php
│       │   └── ViewModel
│       │       ├── CommentViewModel.php
│       │       └── PostViewModel.php
│       ├── Cli
│       └── Http
└── Shared
    ├── Application
    │   └── CommandBusInterface.php
    ├── Domain
    │   ├── Entity
    │   │   └── HasKeyInterface.php
    │   └── ValueObject
    │       ├── IntValue.php
    │       ├── KeyValueCollection.php
    │       └── StringValue.php
    ├── Exception
    │   ├── DomainException.php
    │   ├── ExceptionUtil.php
    │   └── ValueObject
    │       ├── ValueOverMaxException.php
    │       ├── ValueOverMinException.php
    │       └── ValueToLongException.php
    ├── Infrastructure
    │   └── CommandBus.php
    ├── SharedProvider.php
    └── Slug.php
   ```

## Contributing

Thank you for considering contributing to the example.

## License

The example is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
