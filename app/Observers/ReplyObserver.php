<?php

namespace App\Observers;

use App\Models\Reply;
use App\Notifications\TopicReplied;
// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class ReplyObserver
{
    public function creating(Reply $reply)
    {
        //用Purifier进行净化, 具体规则在config/purifier里
        $reply->content = clean($reply->content, 'user_topic_body');
    }

    public function updating(Reply $reply)
    {
        //
    }

    //成功新增一个reply之后, 自动将topic的reply_count加1
    public function created(Reply $reply)
    {
        $reply->topic->updateReplyCount();

        //$reply->topic->reply_count = $reply->topic->replies->count();
        //$reply->topic->save();
        //$reply->topic->increment('reply_count', 1);

        // 通知话题作者有新的评论
        // 这个TopicReplied就是一个通知
        $reply->topic->user->notify(new TopicReplied($reply));
    }

    //删除reply之后, 也要更新一下
    public function deleted(Reply $reply)
    {
        $reply->topic->updateReplyCount();
        //$reply->topic->reply_count = $reply->topic->replies->count();
        //$reply->topic->save();
    }
}