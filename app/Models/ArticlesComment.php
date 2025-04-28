<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticlesComment extends Model
{
    use HasFactory;

    protected $table = 'articles_comments';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'article_id',
        'user_id',
        'parent_id',
        'body'
    ];

    public $sortable = ['created_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    public function replies()
    {
        return $this->hasMany(ArticlesComment::class, 'parent_id');
    }

    public function getList()
    {
        return ArticlesComment::get();
    }
}
