<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Handlers\ImageUploadHandler;

class UsersController extends Controller
{
    public function show(User $user)
    {
        //我的问题是, 到底控制器何时执行的sql查询, 将输入模型对象与数据库对象进行的融合?
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(UserRequest $request,ImageUploadHandler $uploader, User $user)
    {
        $data = $request->all();

        //如果上传了头像
        if ($request->avatar) {
            //尝试保存头像并返回保存目录
            $result = $uploader->save($request->avatar, 'avatars', $user->id);
            //成功之后, 写入数组
            if ($result) {
                $data['avatar'] = $result['path'];
            }
        }

        //写库
        $user->update($data);

        //dd($request->avatar);
        //$user->update($request->all());
        return redirect()->route('users.show', $user->id)->with('success', '个人资料更新成功！');
    }

}