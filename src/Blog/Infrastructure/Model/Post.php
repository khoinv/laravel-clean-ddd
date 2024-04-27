<?php

namespace Src\Blog\Infrastructure\Model;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 *
 *
 * @property int $id
 * @property string|null $title
 * @property string $slug
 * @property string|null $content
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read Collection<int, Comment> $comments
 * @property-read int|null $comments_count
 * @method static Builder|Post newModelQuery()
 * @method static Builder|Post newQuery()
 * @method static Builder|Post onlyTrashed()
 * @method static Builder|Post query()
 * @method static Builder|Post whereContent($value)
 * @method static Builder|Post whereCreatedAt($value)
 * @method static Builder|Post whereDeletedAt($value)
 * @method static Builder|Post whereId($value)
 * @method static Builder|Post whereSlug($value)
 * @method static Builder|Post whereTitle($value)
 * @method static Builder|Post whereUpdatedAt($value)
 * @method static Builder|Post withTrashed()
 * @method static Builder|Post withoutTrashed()
 * @mixin Eloquent
 */
class Post extends Model
{
    use SoftDeletes;

    protected $table = 'blog_posts';
    protected $casts = [];

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, 'post_id', 'id');
    }
}
