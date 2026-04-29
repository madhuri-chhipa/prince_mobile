@extends('frontend.layouts.app')
@section('content')
<div class="bg-blue py-4">
    <div class="container">
        <nav aria-label="breadcrumb" class="my-auto">
            <ol class="breadcrumb my-auto">
                <li class="breadcrumb-item fs-4"><a href="{{ route('home') }}" class="text-light fw-bold">Home</a></li>
                <li class="breadcrumb-item fs-4 active text-light fw-bold" aria-current="page">Testimonials</li>
            </ol>
        </nav>
    </div>
</div>
@if (count($testimonials) > 0)
<div class="container py-4">
    <div class="row row-cols-1 row-cols-md-2 g-4">
        @foreach ($testimonials as $key => $testimonial)
        <div class="col product-card">
            <div class="card pt-4 h-100 rounded-4">
                <div class="rounded-circle mx-auto client-img"><img src="{{ imageexist($testimonial->image) }}" class="img-fluid" alt="..."></div>
                <div class="card-body text-center">
                    <p class="fs-4 fw-bold text-capitalize font-lato">{{ $testimonial->name }} <span class="fs-5 text-secondary">({{ $testimonial->designation }})</span></p>
                    <p class="fs-5 font-lato mb-0">{{ $testimonial->message }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endif
@endsection