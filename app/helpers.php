<?php
/**
 * Created by PhpStorm.
 * User: Marc LAW: zunly@hotmail.com
 * Date: 2018/12/28
 * Time: 10:56
 */

function route_class()
{
    return str_replace('.', '-', Route::currentRouteName());
}