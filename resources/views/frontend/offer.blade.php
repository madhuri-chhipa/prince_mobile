@extends('frontend.layouts.app')
@section('content')
<div class="bg-blue py-4">
    <div class="container">
        <nav aria-label="breadcrumb" class="my-auto">
            <ol class="breadcrumb my-auto">
                <li class="breadcrumb-item fs-4"><a href="{{ route('home') }}" class="text-light fw-bold">Home</a></li>
                <li class="breadcrumb-item fs-4 active text-light fw-bold" aria-current="page">Offers</li>
            </ol>
        </nav>
    </div>
</div>
@if (count($offers) > 0)
<div class="container py-4">
    <div class="row row-cols-1 row-cols-md-2 g-4">
        @foreach ($offers as $key => $offer)
        <div class="col product-card">
            <div class="card" style="height: 250px;">
                <img src="{{ imageexist($offer->image) }}" class="card-img-top img-fluid" alt="...">
            </div>
        </div>
        @endforeach
    </div>
</div>
@endif
@endsection