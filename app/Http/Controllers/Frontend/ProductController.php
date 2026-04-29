<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\BookingInquiry;
use App\Models\ProductToCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index(Request $request, $cat_slug = Null)
    {
        $title = "Products";
    

        $category = Category::where(['slug' => $cat_slug, 'status' => 1])->first();
        
        $categories = Category::select('id', 'name', 'slug', 'parent_id')->with(['childs' => function($value) {
            $value->select('id', 'name', 'slug', 'parent_id')->with(['childs' => function($value) {
                $value->select('id', 'name', 'slug', 'parent_id')->where(['status' => 1])->orderBy('sort_order', 'ASC');
            }])->where(['status' => 1])->orderBy('sort_order', 'ASC');
        }])->where('parent_id','0')->get();
        // dd($categories->toArray());

        $products   = Product::when(!empty($cat_slug), function ($value, $search) use ($category) {
            $value->Join('product_to_categories', function ($value) use ($category) {
                $value->on('product_to_categories.product_id', 'products.id')
                    ->where('category_id', $category->id );
            });
        })->when(!empty($request->search), function ($value, $search) use ($request) {
            $value->where('name', 'LIKE', '%'.$request->search.'%');
        });

        if(!empty($request->sort) && !empty($request->order)) {
            $products->orderBy($request->sort, $request->order);
        }

        $products = $products->paginate(4);

        return view('frontend.product', compact('cat_slug', 'products', 'categories'));
    }

    public function productDetails(Request $request)
    {
        $productdetails = Product::select('products.*', 'manufactures.name AS manufacture_name')
        ->leftJoin('manufactures','products.manufacture_id', '=', 'manufactures.id')
        ->where('slug', $request->product_slug)
        ->first();
        $productimages = ProductImage::when(!empty($request->product_slug), function ($value) use ($productdetails) {
            $value->where('product_id', $productdetails->id);
        })
            ->get();
        return view('frontend.product-details', compact('productdetails', 'productimages'));
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
