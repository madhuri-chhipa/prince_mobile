<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cms;
use App\Models\Product;
use App\Models\Category;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TermsOfServiceController extends Controller
{
    public function index(Request $request)
    {
        
        $title = 'Terms and conditions';
        $cmsterms = Cms::where('id', '3')->where('status',1)->first();

        return view('frontend.terms-service', compact('title','cmsterms'));
    }

}
