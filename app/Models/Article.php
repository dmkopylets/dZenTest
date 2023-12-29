<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $table = 'articles';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'user_id',
        'title',
        'body'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
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
