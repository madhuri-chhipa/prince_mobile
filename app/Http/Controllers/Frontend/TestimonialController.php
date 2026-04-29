<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index(){
        $title = 'Testimonials';
        $testimonials = Testimonial::where('status',1)->get();
        return view('frontend.testimonial', compact('title','testimonials'));
    }
}
