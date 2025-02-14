<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string $content
 * @property Carbon $created_at
 * @property int $id
 * @property int $post_id
 * @property int $reply_to
 * @property Carbon $updated_at
 * @property int $user_id
 * 
 * @property-read Comment $parent
 * @property-read Post $post
 * @property-read User $user
 * @property-read Collection<int, Post> $posts
 * @property-read Collection<int, Tag> $replies
 * @property-read Collection<int, Comment> $users
 */
class Comment extends Model
{
    use HasFactory;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'content',
        'user_id',
        'post_id',
        'reply_to'
    ];

    /**
     * Get the comment's author.
     *
     * @return User
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the post
     *
     * @return Post
     */
    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }

    /**
     * Get the parent comment.
     *
     * @return Comment
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Comment::class, 'reply_to', 'id');
    }

    /**
     * Get the list of replied comments.
     *
     * @return HasMany<Comment, covariant $this>
     */
    public function replies(): HasMany
    {
        return $this->hasMany(Comment::class, 'reply_to', 'id');
    }
}
