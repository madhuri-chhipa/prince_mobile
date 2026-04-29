<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceInquiry;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index(Request $request){
        $title = 'Services';
        $services = Service::where('status',1)->get();
        return view('frontend.service', compact('title','services'));
    }

    public function serviceDetails(Request $request){
        $service = Service::where('slug',$request->service_slug)->first();
        return view('frontend.service-details', compact('service'));
    }

    public function serviceInquiry(Request $request)
    {
        $validate = $request->validate([
            'name'  => 'required|max:150',
            'phone' =>  'required|max:15|min:6',
            'email' => 'required|email',
            'message' => 'required',
        ]);
        $data = new ServiceInquiry;
        $data->service_id = $request->service_id;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->mobile = $request->phone;
        $data->message = $request->message;
        $data->save();

        return back()->withSuccess('Success message');
    }
}
