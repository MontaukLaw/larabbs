<?php

namespace App\Http\Requests;

class ReplyRequest extends Request
{
    //public $content;

    public function rules()
    {
        return [
            'cont' => 'required|min:2',
        ];
//        switch($this->method())
//        {
//            // CREATE
//            case 'POST':
//            {
//                return [
//                    // CREATE ROLES
//                ];
//            }
//            // UPDATE
//            case 'PUT':
//            case 'PATCH':
//            {
//                return [
//                    // UPDATE ROLES
//                ];
//            }
//            case 'GET':
//            case 'DELETE':
//            default:
//            {
//                return [];
//            };
//        }
    }

    public function messages()
    {
        return [
            'cont.min' => '内容必须至少两个字符',
        ];
    }
}
