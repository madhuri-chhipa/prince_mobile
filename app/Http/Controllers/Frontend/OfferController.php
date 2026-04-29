<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function index(){
        $title = 'Offers';
        $offers = Banner::where(['type'=>2, 'status'=>1])->get();
        return view('frontend.offer', compact('title','offers'));
    }
}
