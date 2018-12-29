<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Handlers\ImageUploadHandler;
use Log;
class UsersController extends Controller
{

    public function __construct()
    {
        //Log::debug('access');
        $this->middleware('auth', ['except' => ['show']]);
    }

    public function show(User $user)
    {
        //我的问题是, 到底控制器何时执行的sql查询, 将输入模型对象与数据库对象进行的融合?
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        //原来直接返回view, 但是为了安全性要求, 需要authorize一下先, 防止修改别人的profile
        //return view('users.edit', compact('user'));

        $this->authorize('update', $user);
        return view('users.edit', compact('user'));
    }

    public function update(UserRequest $request,ImageUploadHandler $uploader, User $user)
    {
        //更新之前也要认证一下.
        $this->authorize('update', $user);

        $data = $request->all();

        //如果上传了头像
        if ($request->avatar) {
            //尝试保存头像并返回保存目录
            $result = $uploader->save($request->avatar, 'avatars', $user->id,416);
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
