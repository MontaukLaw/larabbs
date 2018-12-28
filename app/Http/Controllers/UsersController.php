<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    public function show(User $user)
    {
        //我的问题是, 到底控制器何时执行的sql查询, 将输入模型对象与数据库对象进行的融合?
        return view('users.show', compact('user'));
    }
}
