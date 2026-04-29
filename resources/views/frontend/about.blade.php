@extends('frontend.layouts.app')
@section('content')
<div class="bg-blue py-4">
    <div class="container">
        <nav aria-label="breadcrumb" class="my-auto">
            <ol class="breadcrumb my-auto">
                <li class="breadcrumb-item fs-4"><a href="{{ route('home') }}" class="text-light fw-bold">Home</a></li>
                <li class="breadcrumb-item fs-4 active text-light fw-bold" aria-current="page">About Us</li>
            </ol>
        </nav>
    </div>
</div>
@if (!empty($cmsaboutus))
<div class="container py-4 description">
    <h1 class="fs-1 text-primary fw-bold">{{ $cmsaboutus->name }}</h1>
    <p>{!! $cmsaboutus->cms_contant !!}</p>
    <div class="py-3" style="max-width: 600px; max-height:600px;">
        <img src="{{ imageexist($cmsaboutus->image) }}" class="img-fluid" alt="">
    </div>
</div>
@endif
@endsection