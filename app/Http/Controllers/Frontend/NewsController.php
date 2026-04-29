<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index(){
        $title = 'News';
        $news = News::where('status',1)->get();
        return view('frontend.news', compact('title','news'));
    }
}
