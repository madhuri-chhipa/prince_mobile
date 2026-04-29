@extends('frontend.layouts.app')
@section('header_scripts')
<style>
    .error {
        color: red !important;
    }
</style>
@endsection
@section('content')
<!-- slider -->
@if (count($banners) > 0)
<div id="carouselExampleIndicators" class="carousel slide">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
        @foreach ($banners as $key => $banner)
        <div class="carousel-item {{ $key==0?'active':''}}">
            <img src="{{ asset($banner->image) }}" class="d-block w-100" alt="...">
        </div>
        @endforeach
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
@endif

<div class="container">
    <!-- manufactures -->
    @if(count($manufactures) > 0)
    <div class="owl-carousel owl-theme mt-5 pt-5" id="manufactures-owl">
        @foreach ($manufactures as $key => $manufacture)
        <div class="item">
            <div class="card py-2 rounded-4">
                <div class="manufacture-img"><img src="{{ imageexist($manufacture->image) }}" class="img-fluid" alt="..."></div>
            </div>
        </div>
        @endforeach
    </div>
    @endif

    <!-- about -->
    @if (!empty($about))
    <div class="row pt-5 mt-5">
        <div class="col-lg-6 col-12 d-flex justify-content-center">
            <div class="about-img">
                <img src="{{ imageexist($about->image) }}" class="img-fluid" alt="">
            </div>
        </div>
        <div class="col-lg-6 col-12 text-heading text-capitalize mt-lg-0 mt-4 px-5">
            <h1 class="mb-3 fw-bold">About us</h1>
            <h4 class="homecms-description" style="text-align: justify;">
                {!! Str::limit($about->cms_contant1, '460', ' ...') !!}
            </h4>
            <a href="{{ route('about') }}"><button class="btn bg-blue px-4 fs-4 fw-5 text-white mt-4">Read More</button></a>
        </div>
    </div>
    @endif
    <!-- service -->
    @if (count($services) > 0)
    <h1 class="mb-3 fw-bold text-heading pt-5 text-capitalize text-center mt-5">our services</h1>
    <h4 class="fw-5 text-heading text-capitalize text-center homecms-description">{!! Str::limit($serviceCms->cms_contant1, '200', ' ...') !!}</h4>
    <div class="owl-carousel owl-theme mt-5" id="service-owl">
        @foreach ($services as $service)
        <div class="item">
            <div class="card pt-4 rounded-4">
                <div class="service-img bg-blue rounded-circle mx-auto"><img src="{{ imageexist($service->icon) }}" class="px-4 py-3 img-fluid" alt="..."></div>
                <div class="card-body text-center">
                    <h4 class="fw-bold text-capitalize">{{ $service->name }}</h4>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif
    <!-- products -->
    @if(!empty($productCms))
    <div class="row mt-5">
        <div class="col-lg-6 col-12 text-heading text-capitalize mt-5 px-5">
            <h1 class="mb-3 fw-bold">our products</h1>
            <h4 class="homecms-description" style="text-align: justify;">
                {!! Str::limit($productCms->cms_contant1, '460', '...') !!}
            </h4>
            <a href="{{ route('products') }}"><button class="btn bg-blue px-4 fs-4 fw-5 text-white mt-4">Read More</button></a>
        </div>
        <div class="col-lg-6 col-12 mt-4 d-flex justify-content-lg-end justify-content-center">
            <div class="about-img">
                <img src="{{ imageexist($productCms->image) }}" class="img-fluid" alt="">
            </div>
        </div>
    </div>
    @endif
    <!-- trending -->
    @if (count($trendingProducts) > 0)
    <h1 class="mb-3 fw-bold text-heading pt-5 text-capitalize text-center mt-5">trending products</h1>
    <h4 class="fw-5 text-heading text-capitalize text-center homecms-description">{!! Str::limit($trendingCms->cms_contant1, '200', '...') !!}</h4>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xl-4 g-4 mt-3">
        @foreach ($trendingProducts as $Product)
        <div class="col">
            <div class="card rounded-4 pt-4 h-100">
                <a href="{{ route('product-details', ['product_slug'=> $Product->slug]) }}" class="text-uppercase text-decoration-none text-dark mx-auto">
                    <img src="{{ imageexist($Product->default_image) }}" class="card-img-top trending-product-card" alt="...">
                </a>
                <div class="card-body p-0 px-2 text-center">
                    <h4 class="fw-bold text-heading text-capitalize">{{ $Product->name }}</h4>
                    <p><strike class="fs-5">&#8377;{{ $Product->price }}</strike><span class="fs-3 fw-bold mx-2">&#8377;{{ $Product->offer_price }}</span></p>
                </div>
                <div class="card-footer bg-transparent border-0 mx-auto mb-3">
                    <button type="button" class="btn border view-btn text-uppercase" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $Product->id }}">
                        <a>inquiry now</a>
                    </button>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal{{ $Product->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-4 fw-bold text-primary" id="exampleModalLabel">Inquiry Form</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('product-details-inquiry') }}" method="post" id="enquiryForm">
                            <input type="text" name="product_id" value="{{ $Product->id }}" hidden />
                            {{ csrf_field() }}
                            <div class="mb-3">
                                <label for="name" class="form-label fw-bold">Name: </label>
                                <input type="name" name="name" placeholder="Enter Your Name" class="form-control" id="exampleInputname1" aria-describedby="nameHelp">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label fw-bold">Email:</label>
                                <input type="email" name="email" placeholder="Enter Your Email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label fw-bold">Mobile:</label>
                                <input type="phone" name="phone" placeholder="Enter Your Mobile No." class="form-control" id="exampleInputphone1" aria-describedby="nameHelp">
                            </div>
                            <div class="mb-3">
                                <label for="message" class="form-label fw-bold">Message:</label>
                                <textarea type="message" rows="5" name="message" class="form-control" id="exampleInputmessage1" placeholder="Enter Message Here.." aria-describedby="nameHelp"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary mb-3">Submit</button>
                            <button type="button" class="btn btn-secondary mb-3" data-bs-dismiss="modal">Close</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif

</div>
<!-- offer -->
@if (count($offers) > 0)
<div id="carouselOfferIndicators" class="carousel slide my-5">
    <div class="carousel-inner">
        @foreach ($offers as $key => $offer)
        <div class="carousel-item {{ $key==0?'active':''}}">
            <img src="{{ imageexist($offer->image) }}" class="d-block w-100" alt="...">
        </div>
        @endforeach
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselOfferIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselOfferIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
@endif
<div class="container">
    <!-- top selling -->
    @if (count($topProducts) > 0)
    <h1 class="mb-3 fw-bold text-heading pt-5 text-capitalize text-center mt-5">top selling products</h1>
    <h4 class="fw-5 text-heading text-capitalize text-center homecms-description">{!! Str::limit($topCms->cms_contant1, '200', '...') !!}</h4>
    <div class="owl-carousel owl-theme mt-5" id="top-selling-owl">
        @foreach ($topProducts as $Product)
        <div class="item">
            <div class="card rounded-4 pt-4 h-100">
                <a href="{{ route('product-details', ['product_slug'=> $Product->slug]) }}" class="text-uppercase text-decoration-none text-dark">
                    <img src="{{ imageexist($Product->default_image) }}" class="card-img-top mx-auto trending-product-card" alt="...">
                </a>
                <div class="card-body p-2 text-center">
                    <h5 class="fw-bold text-heading text-capitalize">{{ $Product->name }}</h5>
                    <p><strike class="fs-6">&#8377;{{ $Product->price }}</strike><span class="fs-4 fw-bold mx-2">&#8377;{{ $Product->offer_price }}</span></p>
                    <!-- <button class="btn border view-btn mb-2"><a href="#" class="text-uppercase text-decoration-none text-heading"><small>inquire now</small></a></button> -->
                    <div class="card-footer bg-transparent border-0 mx-auto mb-3">
                        <button type="button" class="btn border view-btn text-uppercase" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $Product->id }}">
                            <a>inquiry now</a>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal{{ $Product->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-4 fw-bold text-primary" id="exampleModalLabel">Inquiry Form</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('product-details-inquiry') }}" method="post" id="topenquiryForm">
                                <input type="text" name="product_id" value="{{ $Product->id }}" hidden />
                                {{ csrf_field() }}
                                <div class="mb-3">
                                    <label for="name" class="form-label fw-bold">Name: </label>
                                    <input type="name" name="name" placeholder="Enter Your Name" class="form-control" id="exampleInputname1" aria-describedby="nameHelp">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label fw-bold">Email:</label>
                                    <input type="email" name="email" placeholder="Enter Your Email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                </div>
                                <div class="mb-3">
                                    <label for="phone" class="form-label fw-bold">Mobile:</label>
                                    <input type="phone" name="phone" placeholder="Enter Your Mobile No." class="form-control" id="exampleInputphone1" aria-describedby="nameHelp">
                                </div>
                                <div class="mb-3">
                                    <label for="message" class="form-label fw-bold">Message:</label>
                                    <textarea type="message" rows="5" name="message" class="form-control" id="exampleInputmessage1" placeholder="Enter Message Here.." aria-describedby="nameHelp"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary mb-3">Submit</button>
                                <button type="button" class="btn btn-secondary mb-3" data-bs-dismiss="modal">Close</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>
<!-- testimonial -->
<div class="bg-darkblue mt-5 p-5">
    <div class="container">
        <div class="row mt-4">
            @if(!empty($site_settings['finished_works']))
            <div class="col-lg-3 col-sm-6 col-12 my-lg-0 my-3 text-white text-center my-auto">
                <div class="d-flex justify-content-center">
                    <div class="test-img mx-1 mt-3"><img src="{{  asset('/public/assets/frontend/images/test1.png') }}" alt=""></div>
                    <h1 class="testimonial-heading fw-bold font-poppins mx-3 my-auto">
                        {{ $site_settings[ 'finished_works' ] }}+
                    </h1>
                </div>
                <h5 class="text-capitalize font-poppins my-2">finished works</h5>
            </div>
            @endif
            @if(!empty($site_settings['services']))
            <div class="col-lg-3 col-sm-6 col-12 my-lg-0 my-3 text-white text-center my-auto">
                <div class="d-flex justify-content-center">
                    <div class="test-img mx-1 mt-3"><img src="{{  asset('/public/assets/frontend/images/test2.png') }}" alt=""></div>
                    <h1 class="testimonial-heading fw-bold font-poppins mx-3 my-auto">
                        {{ $site_settings[ 'service' ] }}+
                    </h1>
                </div>
                <h5 class="text-capitalize font-poppins my-2">services</h5>
            </div>
            @endif

            @if(!empty($site_settings['team_member']))
            <div class="col-lg-3 col-sm-6 col-12 my-lg-0 my-3 text-white text-center my-auto">
                <div class="d-flex justify-content-center">
                    <div class="test-img mx-1 mt-3"><img src="{{  asset('/public/assets/frontend/images/test3.png') }}" alt=""></div>
                    <h1 class="testimonial-heading fw-bold font-poppins mx-3 my-auto">
                        {{ $site_settings[ 'team_member' ] }}+
                    </h1>
                </div>
                <h5 class="text-capitalize font-poppins my-2">team member</h5>
            </div>
            @endif

            @if(!empty($site_settings['happy_clients']))
            <div class="col-lg-3 col-sm-6 col-12 my-lg-0 my-3 text-white text-center my-auto">
                <div class="d-flex justify-content-center">
                    <div class="test-img mx-1 mt-3"><img src="{{  asset('/public/assets/frontend/images/test4.png') }}" alt=""></div>
                    <h1 class="testimonial-heading fw-bold font-poppins mx-3 my-auto">
                        {{ $site_settings[ 'happy_clients' ] }}+
                    </h1>
                </div>
                <h5 class="text-capitalize font-poppins my-2">happy clients</h5>
            </div>
            @endif
        </div>
    </div>
</div>
<div class="container">
    <h1 class="fw-bold text-heading pt-5 text-capitalize text-center mt-5">testimonials</h1>
    <h4 class="fw-5 text-heading text-capitalize text-center">{!! Str::limit($testimonialCms->cms_contant1, '200', '...') !!}</h4>
    <div class="owl-carousel owl-theme mt-5" id="testimonial-owl">
        @foreach ($testimonials as $testimonial)
        <div class="item">
            <div class="card pt-4 rounded-4">
                <div class="rounded-circle mx-auto client-img"><img src="{{ imageexist($testimonial->image) }}" class="img-fluid" alt="..."></div>
                <div class="card-body text-center">
                    <h4 class="fw-bold text-capitalize font-lato">{{ $testimonial->name }}</h4>
                    <p class="fs-5 font-lato mb-0">{!! Str::limit($testimonial->message, '120', '...') !!}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
<div>

</div>
@endsection
@section('footer_scripts')
@if(Session::has('success'))
<script type="text/javascript">
    function massge() {
        Swal.fire(
            'Thankyou for submission.',
            'we will contact you with in 24 hours.',
            'success'
        );
    }
    window.onload = massge;
    $('input').val('');
</script>
@endif
<script>
    $('#enquiryForm').validate({
        rules: {
            name: {
                required: true,
                minlength: 3 // For length of name
            },
            email: {
                required: true,
                email: true
            },
            phone: {
                required: true,
                minlength: 6, // For length of name
                maxlength: 15,
                number: true
            },
            message: {
                required: true,
            }
        },
        // In 'messages' user have to specify message as per rules
        messages: {
            name: {
                required: " Please enter your name",
                minlength: " Your name must consist of at least 3 characters"
            },
            email: {
                required: "Please enter your email address",
                email: "Please enter a valid email address"
            },
            phone: {
                required: " Please enter your mobile no.",
                minlength: " Your mobile no. must be consist of at least 6 digits",
                maxlength: " Your mobile no. must not be greater  than 15 digits",
                number: " Only numbers are allowed."
            },
            message: {
                required: "Please enter message"
            }
        },
    });
    $('#topenquiryForm').validate({
        rules: {
            name: {
                required: true,
                minlength: 3 // For length of name
            },
            email: {
                required: true,
                email: true
            },
            phone: {
                required: true,
                minlength: 6, // For length of name
                maxlength: 15,
                number: true
            },
            message: {
                required: true,
            }
        },
        // In 'messages' user have to specify message as per rules
        messages: {
            name: {
                required: " Please enter your name",
                minlength: " Your name must consist of at least 3 characters"
            },
            email: {
                required: "Please enter your email address",
                email: "Please enter a valid email address"
            },
            phone: {
                required: " Please enter your mobile no.",
                minlength: " Your mobile no. must be consist of at least 6 digits",
                maxlength: " Your mobile no. must not be greater  than 15 digits",
                number: " Only numbers are allowed."
            },
            message: {
                required: "Please enter message"
            }
        },
    });
    $('#service-owl').owlCarousel({
        loop: true,
        margin: 10,
        nav: false,
        dots: false,
        autoplay: true,
        responsive: {
            0: {
                items: 1
            },
            500: {
                items: 2
            },
            950: {
                items: 3
            },
            1150: {
                items: 4
            }
        }
    })
    $('#top-selling-owl').owlCarousel({
        loop: true,
        margin: 10,
        nav: false,
        dots: false,
        autoplay: true,
        responsive: {
            0: {
                items: 1
            },
            500: {
                items: 2
            },
            800: {
                items: 3
            },
            1000: {
                items: 4
            },
            1150: {
                items: 5
            }
        }
    })
    $('#testimonial-owl').owlCarousel({
        loop: true,
        margin: 10,
        nav: false,
        dots: false,
        autoplay: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 2
            },
            1000: {
                items: 3
            }
        }
    })
    $('#manufactures-owl').owlCarousel({
        loop: true,
        margin: 10,
        nav: false,
        dots: false,
        autoplay: true,
        responsive: {
            0: {
                items: 1
            },
            200: {
                items: 2
            },
            350: {
                items: 3
            },
            600: {
                items: 4
            },
            800: {
                items: 6
            },
            1000: {
                items: 7
            }
        }
    })
</script>
@endsection