<?php

namespace App\Models;

class Reply extends Model
{
    //protected $fillable = ['topic_id', 'user_id', 'content'];
    //回复只允许修改content字段
    protected $fillable = ['content'];

    //跟topic之间, 是丛属的关系, 一个reply只属于一个topic
    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    //同样, 一个reply只从属于一个发帖人User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
