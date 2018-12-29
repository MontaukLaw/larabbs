<?php

namespace App\Models;

class Topic extends Model
{
    protected $fillable = ['title', 'body', 'user_id', 'category_id', 'reply_count', 'view_count', 'last_reply_user_id', 'order', 'excerpt', 'slug'];

    //这类function表达式一种关系, 即Topic是由归属的, 只属于一个类别, 同时只可能由一个发帖人.
    //通过function调用可以获得对应的归属 例如 $topic->category, $topic->user
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
