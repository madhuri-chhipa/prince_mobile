<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cms;
use App\Models\Product;
use App\Models\Category;
use App\Models\HomeCms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AboutUsController extends Controller
{
    public function index(Request $request)
    {
        
        $title = 'About Us';
        $cmsaboutus = Cms::where(['id'=>1, 'status' => 1])->first();
        return view('frontend.about', compact('title','cmsaboutus'));
    }

}
