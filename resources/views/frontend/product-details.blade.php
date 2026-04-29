@extends('frontend.layouts.app')
@section('header_scripts')
<style>
    .error {
        color: red;
    }

    .column {
        float: left;
        height: 100px;
        padding: 10px;
    }

    /* Style the images inside the grid */
    .column img {
        opacity: 0.8;
        cursor: pointer;
    }

    .column img:hover {
        opacity: 1;
    }

    /* Clear floats after the columns */
    .row:after {
        content: "";
        display: table;
        clear: both;
    }
    .owl-carousel .owl-nav button.owl-prev{
        position: absolute !important;
        top: 30px !important;
        left: -25px !important;
        font-size: 20px !important;
    }
    .owl-carousel .owl-nav button.owl-next{
        position: absolute !important;
        top: 30px !important;
        right: -25px !important;
        font-size: 20px !important;
    }
    /* The expanding image container (positioning is needed to position the close button and the text) */
    .gallery-container {
        position: relative;
    }
</style>
@endsection
@section('content')
<div class="bg-blue py-4">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-auto">
                <li class="breadcrumb-item fs-4"><a href="{{ route('home') }}" class="text-light fw-bold">Home</a></li>
                <li class="breadcrumb-item fs-4"><a href="{{ route('products') }}" class="text-light fw-bold">Product</a></li>
                <li class="breadcrumb-item fs-4 active text-light fw-bold" aria-current="page">Product Details</li>
            </ol>
        </nav>
    </div>
</div>
<div class="container py-5">
    <div class="row">
        <div class="col-md-4">
            <div class="gallery-container" style="height:350px; width: auto;">
                <!-- Expanded image -->
                <img id="expandedImg" src="{{ imageexist($productdetails->default_image) }}" class="img-fluid">
            </div>
              <!-- The expanding image container -->
            <div class="owl-carousel owl-theme mt-5" id="product-img-owl">
                @foreach ($productimages as $images)
                <div class="item">
                    <div class="card">
                    <div class="column border">
                        <img src="{{ imageexist($images->image) }}" alt="Nature" class="img-fluid" onclick="myFunction(this);">
                    </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="col-md-8">
            <h3 class="fw-bold text-darkft text-capitalize">{{ $productdetails->name }}</h3>
            <h5 class="fw-bold text-muted text-capitalize bg-lightgray p-2" style="width: fit-content;">{{ $productdetails->manufacture_name }}</h5>
            <p><strike class="fs-5">&#8377;{{ $productdetails->price }}</strike><span class="fs-4 fw-bold mx-2">&#8377;{{ $productdetails->offer_price }}</span></p>
            <p class="fw-5 lh-lg text-darkft">{{ $productdetails->sort_description }}</p>
            <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Inquiry Now
            </button>
        </div>
    </div>
    <div class="row description">
        <p>{!! $productdetails->full_description !!}</p>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-4 fw-bold text-primary" id="exampleModalLabel">Inquiry Form</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('product-details-inquiry') }}" method="post" id="enquiryForm">
                        <input type="text" name="product_id" value="{{ $productdetails->id }}" hidden />
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
@endsection
@section('footer_scripts')
<script type="text/javascript">
    function myFunction(imgs) {
        // Get the expanded image
        var expandImg = document.getElementById("expandedImg");
        // Use the same src in the expanded image as the image being clicked on from the grid
        expandImg.src = imgs.src;
    }
</script>
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
    $('#product-img-owl').owlCarousel({
        loop: false,
        margin: 10,
        nav: true,
        navText: ["<i class='bi bi-caret-left-fill'></i>","<i class='bi bi-caret-right-fill'></i>"],
        dots: false,
        autoplay: true,
        responsive: {
            0: {
                items: 1
            },
            200:{
                items: 2
            },
            400:{
                items: 3
            },
            500:{
                items: 4
            },
            750: {
                items: 2
            },
            1000: {
                items: 3
            }
        }
    })
</script>
@endsection