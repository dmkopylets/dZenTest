<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
    protected $fillable = ['title', 'slug'];

    public function articles(): BelongsToMany
    {
        return $this->belongsToMany(Article::class);
    }
    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class);
    }
}
