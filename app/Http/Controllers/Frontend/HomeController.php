<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\BookingInquiry;
use App\Models\HomeCms;

use App\Models\Product;
use App\Models\Category;
use App\Models\Manufacture;
use App\Models\ProductImage;
use App\Models\Service;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
       $banners = Banner::select('id', 'name', 'title', 'image', 'status')->where(array('type'=> 1,'status'=>1))
        ->whereNull('deleted_at')
        ->orderBy('id', 'desc')
        ->get();
            
        $manufactures = Manufacture::whereNull('deleted_at')->orderBy('id', 'asc')->where('status', '1')->get();

        $about = HomeCms::firstWhere('id','=','1'); 
        $serviceCms = HomeCms::firstWhere('id','=','2');
        $services = Service::where('status','1')
        ->whereNull('deleted_at')
        ->orderBy('id', 'desc')
        ->get();

        $productCms = HomeCms::firstWhere('id','=','3');
        $trendingCms = HomeCms::firstWhere('id','=','4');
        $topCms = HomeCms::firstWhere('id','=','5');
        $testimonialCms = HomeCms::firstWhere('id','=','6');

        $trendingProducts = Product::where(array('is_trending'=> 1,'status'=>1))
        ->whereNull('deleted_at')
        ->orderBy('sort_order', 'asc')
        ->take(8)
        ->get();

        $topProducts = Product::where(array('is_top'=> 1,'status'=>1))
        ->whereNull('deleted_at')
        ->orderBy('sort_order', 'asc')
        ->get(); 

        $offers = Banner::select('id', 'name', 'title', 'image', 'status')->where(array('type'=> 2,'status'=>1))
        ->whereNull('deleted_at')
        ->orderBy('id', 'desc')
        ->get();

        $testimonials = Testimonial::where('status', '1')
        ->whereNull('deleted_at')
        ->orderBy('sort_order', 'asc')
        ->get();  

        $title = 'Prince Mobile Home Page';
        return view('frontend.index', compact('title', 'banners','manufactures','about','serviceCms','services','productCms','trendingCms','trendingProducts','offers','topCms','topProducts','testimonialCms','testimonials'));
    }

    public function productInquiry(Request $request)
    {
        $validate = $request->validate([
            'name'  => 'required|max:150',
            'phone' =>  'required|max:15|min:6',
            'email' => 'required|email',
            'message' => 'required',
        ]);
        $data = new BookingInquiry;
        $data->product_id = $request->product_id;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->mobile = $request->phone;
        $data->message = $request->message;
        $data->save();
      
        return back()->withSuccess('Success message');
    }
}
