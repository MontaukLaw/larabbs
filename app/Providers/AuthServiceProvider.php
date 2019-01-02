<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Horizon\Horizon;
use Auth;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
		 \App\Models\Reply::class => \App\Policies\ReplyPolicy::class,
		 \App\Models\Topic::class => \App\Policies\TopicPolicy::class,
        'App\Model' => 'App\Policies\ModelPolicy',
        //把User的规则单独跟自定义的一个Policy类联系起来, 确切的说, 是一个方法对应一个规则
        \App\Models\User::class  => \App\Policies\UserPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Horizon::auth(function ($request) {
            // 是否是站长
            return Auth::user()->hasRole('Founder');
        });
    }
}
