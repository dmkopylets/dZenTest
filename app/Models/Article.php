<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Article extends Model
{
    use HasFactory;

    protected $table = 'articles';

    protected $fillable = [
        'title',
        'slug',
        'thumbnail',
        'body',
        'active',
        'published_at',
        'user_id',
        'meta_title',
        'meta_description',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function getList(? string $wantedAuthor, ? string $wantedTitle)
    {
        $list = self::select(
            'articles.id',
            'articles.user_id',
            'articles.title',
            'articles.body',
            'articles.created_at',
            'users.name as user_name',
            'users.email as user_email'
        )
            ->where('users.name', 'like', '%' . $wantedAuthor . '%')
            ->where('title', 'like', '%' . $wantedTitle . '%')
            ->leftJoin('users', 'articles.user_id', '=', 'users.id')
            ->get();
        return $list;
    }
}
