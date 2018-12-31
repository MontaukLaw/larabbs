<?php

namespace App\Observers;

use App\Models\Topic;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class TopicObserver
{
    public function creating(Topic $topic)
    {
        //
    }

    public function updating(Topic $topic)
    {
        //
    }

    //saving的时候启动观察者任务
    public function saving(Topic $topic)
    {
        $topic->body = clean($topic->body, 'user_topic_body');
        //make_excerpt 方法是helper函数里面的
        $topic->excerpt = make_excerpt($topic->body);
    }
}