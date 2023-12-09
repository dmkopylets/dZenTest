<?php

namespace App\Models;

use Franzose\ClosureTable\Models\Entity;
use App\Models\ArticlesCommentClosure;

class ArticlesComment extends Entity
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function article()
    {
        return $this->belongsTo(Article::class);
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



}
