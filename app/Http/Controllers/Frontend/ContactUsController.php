<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\GeneralInquiry;
use Illuminate\Http\Request;
use App\Models\Category;

class ContactUsController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Contact Us';
        
        return view('frontend.contact', compact('title'));
    }

    public function contactSubmit(Request $request){
        $validate = $request->validate([
            'name'  => 'required|max:150',
            'phone'=>  'required|max:15|min:6',
            'email'=> 'required|email',
            'message'=>'required',
        ]);
        $data = new GeneralInquiry;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->mobile = $request->phone;
        $data->message = $request->message;
        $data->save();
       return back()->withSuccess('Success message');
    }
}
