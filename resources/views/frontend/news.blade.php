@extends('frontend.layouts.app')
@section('content')
<div class="bg-blue py-4">
    <div class="container">
        <nav aria-label="breadcrumb" class="my-auto">
            <ol class="breadcrumb my-auto">
                <li class="breadcrumb-item fs-4"><a href="{{ route('home') }}" class="text-light fw-bold">Home</a></li>
                <li class="breadcrumb-item fs-4 active text-light fw-bold" aria-current="page">News</li>
            </ol>
        </nav>
    </div>
</div>
@if (count($news) > 0)
<div class="container py-4">
    <div class="row row-cols-1 row-cols-lg-2 g-4">
        @foreach ($news as $key => $new)
        <div class="col">
        <div class="card h-100 p-2">
            <div class="row g-0">
                <div class="col-sm-4 my-auto" style="height: 200px;">
                    <img src="{{ imageexist($new->image) }}" class="img-fluid rounded-start" alt="...">
                </div>
                <div class="col-sm-8">
                <div class="card-body">
                    <h4 class="card-title fw-bold text-capitalize">{{ $new->title }}</h4>
                    <h6 class="bg-primary text-white p-2" style="width: fit-content;">{{ date('d-m-Y h:i a', strtotime($new->date)) }}</h6>
                    <p class="fs-6 mb-0">{{ $new->short_description }}</p>
                </div>
                </div>
            </div>
        </div>
        </div>
        @endforeach
    </div>
</div>
@endif
@endsection
