<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    //返回的root的view
    public function root()
    {
        return view('pages.root');
    }
}
