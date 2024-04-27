<?php

namespace Src\Blog\Infrastructure\Model;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 *
 *
 * @property int $id
 * @property int $post_id
 * @property string|null $content
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @method static Builder|Comment newModelQuery()
 * @method static Builder|Comment newQuery()
 * @method static Builder|Comment onlyTrashed()
 * @method static Builder|Comment query()
 * @method static Builder|Comment whereContent($value)
 * @method static Builder|Comment whereCreatedAt($value)
 * @method static Builder|Comment whereDeletedAt($value)
 * @method static Builder|Comment whereId($value)
 * @method static Builder|Comment wherePostId($value)
 * @method static Builder|Comment whereUpdatedAt($value)
 * @method static Builder|Comment withTrashed()
 * @method static Builder|Comment withoutTrashed()
 * @mixin Eloquent
 */
class Comment extends Model
{
    use SoftDeletes;

    protected $table = 'blog_comments';

    protected $casts = [];
}
