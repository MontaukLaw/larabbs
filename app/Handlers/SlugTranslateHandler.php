<?php
/**
 * Created by PhpStorm.
 * User: Marc LAW: zunly@hotmail.com
 * Date: 2018/12/31
 * Time: 9:33
 */

namespace App\Handlers;

use GuzzleHttp\Client;
use Overtrue\Pinyin\Pinyin;

class SlugTranslateHandler
{
    public function youdaoTranslate($text)
    {
        //q	text	要翻译的文本	True	必须是UTF-8编码
        //from	text	源语言	True	中文	zh-CHS
        //to	text	目标语言	True	英文	EN
        //appKey	text	应用 ID	True	554857ac01f13af4
        //salt	text	随机数	True
        //sign	text	签名，通过md5(appKey+q+salt+应用密钥)生成	True	appKey+q+salt+应用密钥的MD5值
        //应用密钥C8lWIN8BGzNHsV4ZeK5nF85OqAaj8HUu

        // 实例化 HTTP 客户端
        $http = new Client;

        // 初始化配置信息
        $api = 'http://openapi.youdao.com/api?';
        $appKey = '554857ac01f13af4'; //跟百度不同, 有道把id叫key
        $key = 'C8lWIN8BGzNHsV4ZeK5nF85OqAaj8HUu';
        $salt = time();
        $sign = md5($appKey . $text . $salt . $key); //顺序跟百度一样, key+q+随机+密钥

        // 构建请求参数
        $query = http_build_query([
            "q" => $text,
            "from" => "zh-CHS",
            "to" => "EN",
            "appKey" => $appKey,
            "salt" => $salt,
            "sign" => $sign,
        ]);

        // 发送 HTTP Get 请求
        $response = $http->get($api . $query);

        // 转jason为数组
        $result = json_decode($response->getBody(), true);

        // 获取错误码
        $errorCode = $result['errorCode'];

        // 获取翻译结果
        $trans = $result['translation'];

        //return $result;

        // 如果有结果, 就返回, 如果没有, 就返回拼音结果
        if ($errorCode == '0') {
            return str_slug($trans[0]);
        } else {
            return $this->pinyin($text);
        }

        //return $result;
    }

    public function translate($text)
    {
        // 实例化 HTTP 客户端
        $http = new Client;

        // 初始化配置信息
        $api = 'http://api.fanyi.baidu.com/api/trans/vip/translate?';
        $appid = config('services.baidu_translate.appid');
        $key = config('services.baidu_translate.key');
        $salt = time();

        // 如果没有配置百度翻译，自动使用兼容的拼音方案
        if (empty($appid) || empty($key)) {
            return $this->pinyin($text);
        }

        // 根据文档，生成 sign
        // http://api.fanyi.baidu.com/api/trans/product/apidoc
        // appid+q+salt+密钥 的MD5值
        $sign = md5($appid . $text . $salt . $key);

        // 构建请求参数
        $query = http_build_query([
            "q" => $text,
            "from" => "zh",
            "to" => "en",
            "appid" => $appid,
            "salt" => $salt,
            "sign" => $sign,
        ]);

        // 发送 HTTP Get 请求
        $response = $http->get($api . $query);

        $result = json_decode($response->getBody(), true);

        /**
         * 获取结果，如果请求成功，dd($result) 结果如下：
         *
         * array:3 [▼
         * "from" => "zh"
         * "to" => "en"
         * "trans_result" => array:1 [▼
         * 0 => array:2 [▼
         * "src" => "XSS 安全漏洞"
         * "dst" => "XSS security vulnerability"
         * ]
         * ]
         * ]
         **/

        // 尝试获取获取翻译结果
        if (isset($result['trans_result'][0]['dst'])) {
            return str_slug($result['trans_result'][0]['dst']);
        } else {
            // 如果百度翻译没有结果，使用拼音作为后备计划。
            return $this->pinyin($text);
        }
    }

    public function pinyin($text)
    {
        return str_slug(app(Pinyin::class)->permalink($text));
    }
}