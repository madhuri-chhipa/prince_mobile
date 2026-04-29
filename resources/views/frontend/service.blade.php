@extends('frontend.layouts.app')
@section('content')
<div class="bg-blue py-4">
    <div class="container">
        <nav aria-label="breadcrumb" class="my-auto">
            <ol class="breadcrumb my-auto">
                <li class="breadcrumb-item fs-4"><a href="{{ route('home') }}" class="text-light fw-bold">Home</a></li>
                <li class="breadcrumb-item fs-4 active text-light fw-bold" aria-current="page">Services</li>
            </ol>
        </nav>
    </div>
</div>
@if (count($services) > 0)
<div class="container py-4">
    <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3 g-4">
        @foreach ($services as $key => $service)
        <div class="col product-card">
            <div class="card pt-4 rounded-4 h-100">
                <div style="height: 200px; width: 200px;" class="mx-auto"><img src="{{ imageexist($service->image) }}" class="card-img-top img-fluid" alt="..."></div>
                <div class="card-body text-center">
                    <h4 class="fw-bold text-capitalize font-lato">{{ $service->name }}</h4>
                    <p class="fs-5 font-lato mb-0">{{ $service->short_description }}</p>
                </div>
                <div class="card-footer border-0 bg-transparent mx-auto mb-2">
                    <a href="{{ route('services',['service_slug'=> $service->slug]) }}"><button class="btn btn-outline-primary">View More</button></a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endif
@endsection