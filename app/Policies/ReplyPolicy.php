<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Reply;

class ReplyPolicy extends Policy
{
    public function update(User $user, Reply $reply)
    {
        // return $reply->user_id == $user->id;
        return true;
    }

    public function destroy(User $user, Reply $reply)
    {
        //删除reply的, 只能是reply的作者或者topic作者
        return $user->isAuthorOf($reply) || $user->isAuthorOf($reply->topic);
        //return true;
    }
}
