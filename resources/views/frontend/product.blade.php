@extends('frontend.layouts.app')
@section('content')
<div class="bg-blue py-4">
    <div class="container">
        <nav aria-label="breadcrumb" class="my-auto">
            <ol class="breadcrumb my-auto">
                <li class="breadcrumb-item fs-4"><a href="{{ route('home') }}" class="text-light fw-bold">Home</a></li>
                <li class="breadcrumb-item fs-4 active text-light fw-bold" aria-current="page">Products</li>
            </ol>
        </nav>
    </div>
</div>
<div class="container py-5">
    <div class="row">
        <div class="col-lg-3 col-md-4">
            <div class="nav flex-column me-5 w-100" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <h3 class="mb-3 fw-bold text-heading text-capitalize d-none d-md-block">Categories</h3>
                <nav class="navbar navbar-expand-md navbar-dark">
                    <button class="navbar-toggler text-light border-0 bg-dark" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar">
                        <span class="navbar-toggler-icon bg-dark"></span>
                    </button>
                    <div class="offcanvas bg-lightgray offcanvas-end" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
                        <div class="offcanvas-header">
                            <h3 class="fw-bold text-capitalize">Categories</h3>
                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body d-block">
                            <div class="accordion accordion-flush" id="category">
                                @foreach ($categories as $pkey => $pvalue)
                                <div class="accordion-item">
                                    <h2 class="accordion-header py-1 d-flex justify-content-between align-items-center">
                                        <a href="{{ route('products', ['cat_slug' => $pvalue->slug]) }}" class="text-decoration-none fs-6 text-secondary category-name">{{ $pvalue->name }}</a>
                                        <button class="accordion-button w-auto bg-transparent collapsed py-2" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse{{ $pvalue->id }}" aria-expanded="false" aria-controls="flush-collapse{{ $pvalue->id }}"></button>
                                    </h2>
                                    <div id="flush-collapse{{ $pvalue->id }}" class="accordion-collapse collapse" data-bs-parent="#category">
                                        <div class="accordion-body p-0">
                                            @foreach ($pvalue->childs as $skey => $svalue)
                                            <div class="accordion-item py-0">
                                                <h2 class="accordion-header d-flex justify-content-between align-items-center">
                                                    <a href="{{ route('products', ['cat_slug' => $svalue->slug]) }}" class="text-decoration-none fs-6 px-3 text-secondary category-name">{{ $svalue->name }}</a>
                                                    <button class="accordion-button w-auto bg-transparent collapsed py-2" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse{{ $svalue->id }}" aria-expanded="false" aria-controls="flush-collapse{{ $svalue->id }}"></button>
                                                </h2>
                                                <div id="flush-collapse{{ $svalue->id }}" class="accordion-collapse collapse" data-bs-parent="#flush-collapse{{ $pvalue->id }}">
                                                    <div class="accordion-body p-0">
                                                        @foreach ($svalue->childs as $ckey => $cvalue)
                                                        <div class="accordion-item py-2 px-5">
                                                            <a href="{{ route('products', ['cat_slug' => $cvalue->slug]) }}" class="text-decoration-none accordion-header text-dark category-name">
                                                                {{ $cvalue->name }}
                                                            </a>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>

                        </div>
                    </div>
                </nav>
                <!-- <a href="{{ route('products')}}" class="nav-link fw-bold my-2 w-100 @if(empty(request()->cat_slug)) active @endif" id="v-pills-home-tab">All</a> -->
            </div>
        </div>
        <div class="col-lg-9 col-md-8">
            @if(count($products) > 0)
            <div class="row">
                <div class="col-md-6 col-sm-8">
                    <form class="d-flex" action="{{ route('products', ['cat_slug' => $cat_slug]) }}" method="GET">
                        <input class="form-control rounded-end-0 border border-primary" value="{{ request()->search }}" type="text" name="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-primary me-3 rounded-start-0" type="submit"><i class="bi bi-search"></i></button>
                    </form>
                </div>
                <div class="col-md-6 col-sm-4 mt-sm-0 mt-2">
                    <select class="form-select border border-primary" name="priceSort" aria-label="Default select example" onchange="location = this.value;">
                        <option value="default">Sort By: </option>
                        <option value="{{ route('products', ['cat_slug' => $cat_slug, 'search' => request()->search, 'sort' => 'price', 'order' => 'ASC']) }}" <?php if (request()->order == 'ASC') echo 'selected="selected"'; ?>>Low to High</>
                        </option>
                        <option value="{{ route('products', ['cat_slug' => $cat_slug, 'search' => request()->search, 'sort' => 'price', 'order' => 'DESC']) }}" <?php if (request()->order == 'DESC') echo 'selected="selected"'; ?>>High to Low</option>
                    </select>
                </div>
            </div>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xl-4 g-2 mt-3">
                @foreach ($products as $product)
                <div class="col product-card">
                    <div class="card px-3 rounded-4 pt-3 h-100">
                        <div style="height: 200px; width: 200px;" class="mx-auto">
                            <img src="{{ imageexist($product->default_image) }}" class="card-img-top mx-auto img-fluid" alt="...">
                        </div>
                        <div class="card-body text-center p-0 pt-2">
                            <h5 class="fw-bold text-heading text-capitalize">{{ $product->name }}</h5>
                            <p><strike class="fs-6">&#8377;{{ $product->price }}</strike><span class="fs-5 fw-bold mx-2">&#8377;{{ $product->offer_price }}</span></p>
                        </div>
                        <div class="card-footer pb-4 p-0 border-0 bg-transparent text-center">
                            <button class="btn border border-2 view-btn fs-6"><a href="{{ route('product-details', ['product_slug'=> $product->slug]) }}" class="text-uppercase text-decoration-none text-dark">View More</a></button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="pagination-block mt-5">
                {{ $products->links('frontend.layouts.paginatorlinks') }}
            </div>
            @else
            <p class="fs-5 fw-5 mt-5 text-center">No products found in this category.</p>
            @endif
        </div>
    </div>
</div>
@endsection
@section('footer_scripts')
<script>
</script>
@endsection