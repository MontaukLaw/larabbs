<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Topic;

class CategoriesController extends Controller
{
    //这个方法返回的是此分类下的所有文章列表, 并按默认20条每页分页.
    public function show(Category $category,Request $request, Topic $topic)
    {

        $topic=  Topic::with('user', 'category')->withOrder($request->order);
        // 读取分类 ID 关联的话题，并按每 20 条分页
        $topics = $topic->where('category_id', $category->id)->paginate(20);
        // 传参变量话题和分类到topics的index模板中
        return view('topics.index', compact('topics', 'category'));

        // 读取分类 ID 关联的话题，并按每 20 条分页
        //$topics = Topic::where('category_id', $category->id)->paginate(20);
        // 传参变量话题和分类到topics的index模板中
        //return view('topics.index', compact('topics', 'category'));
    }
}
