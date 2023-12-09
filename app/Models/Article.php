<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $table = 'articles';
    protected $primaryKey = 'id';
    protected $appends = ['user_name'];
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

    public function getList()
    {
        $list = self::get();
        // $arrayList = $list->toArray();
        // foreach ($list as $key => $value) {
        //     $arrayList[$key]['user_name'] = $value->user->name;
        // }
        // return $arrayList;
        return $list;
    }

    public function getUserNameAttribute(): void
    {

    }
}
