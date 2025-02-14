<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property string $name
 * @property int $id
 * @property string $title
 * @property-read Collection<int, Comment> $comments
 */
class Tag extends Model
{
    use HasFactory;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
    ];

    /**
     * Get the list of posts with current tag.
     *
     * @return BelongsToMany<Post, covariant $this>
     */
    public function posts(): BelongsToMany

    {
        return $this->belongsToMany(Post::class);
    }
}
