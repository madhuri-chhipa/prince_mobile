@extends('frontend.layouts.app')
@section('content')
<div class="bg-blue py-4">
    <div class="container">
        <nav aria-label="breadcrumb" class="my-auto">
            <ol class="breadcrumb my-auto">
                <li class="breadcrumb-item fs-4"><a href="{{ route('home') }}" class="text-light fw-bold">Home</a></li>
                <li class="breadcrumb-item fs-4 active text-light fw-bold" aria-current="page">Privacy policy</li>
            </ol>
        </nav>
    </div>
</div>
@if (!empty($cmsprivacy))
<div class="container py-4 description">
    <h1 class="text-primary fw-bold">{{ $cmsprivacy->name }}</h1>
    <p>{!! $cmsprivacy->cms_contant !!}</p>
    <div class="py-3" style="max-width: 600px; max-height:600px;">
        <img src="{{ imageexist($cmsprivacy->image) }}" class="img-fluid" alt="">
    </div>
</div>
@endif
@endsection