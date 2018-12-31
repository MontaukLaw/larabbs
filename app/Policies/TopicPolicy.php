<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Topic;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class TopicPolicy extends Policy
{
    public function update(User $user, Topic $topic)
    {
        // return $topic->user_id == $user->id;
        //return true;
        //在执行Topic的update方法时, 自动比对当前user的身份跟修改的topic的id身份是否相同, 返回值为true跟false
        //return $topic->user_id == $user->id;
        return $user->isAuthorOf($topic);
    }

    public function destroy(User $user, Topic $topic)
    {
        return $user->isAuthorOf($topic);
    }


}
