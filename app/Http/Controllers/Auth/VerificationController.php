<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\VerifiesEmails;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //所有控制器动作在认证之后才能范文
        $this->middleware('auth');
        //只有认证verify动作使用signed路由签名中间件进行认证
        $this->middleware('signed')->only('verify');
        //一分钟内, resend不能超过6次
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

//    public function show()
//    {
//        return view('auth.verify');
//    }
}
