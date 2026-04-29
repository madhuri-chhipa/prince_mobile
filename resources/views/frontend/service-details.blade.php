@extends('frontend.layouts.app')
@section('header_scripts')
<style>
    .error {
        color: red;
    }
</style>
@endsection
@section('content')
<div class="bg-blue py-4">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-auto">
                <li class="breadcrumb-item fs-4"><a href="{{ route('home') }}" class="text-light fw-bold">Home</a></li>
                <li class="breadcrumb-item fs-4"><a href="{{ route('services') }}" class="text-light fw-bold">services</a></li>
                <li class="breadcrumb-item fs-4 active text-light fw-bold" aria-current="page">{{ $service->name }}</li>
            </ol>
        </nav>
    </div>
</div>
<div class="container py-5">
    <div class="row">
        <div class="col-md-4" style="height:350px; width: 300;">
            <img src="{{ imageexist($service->image) }}" class="img-fluid">
        </div>
        <div class="col-md-8">
            <h3 class="fw-bold text-darkft text-capitalize text-primary">{{ $service->name }}</h3>
            <p class="fs-4 fw-bold mx-2">&#8377;{{ $service->price }}</p>
            <p class="fw-5 lh-lg fs-5 text-darkft">{{ $service->short_description }}</p>
            <a href="{{ imageexist($service->brochure) }}" download="GFG">
                <button type="button" class="btn btn-outline-primary btn-lg">Download PDF</button>
            </a>
        </div>
    </div>
    <div class="row description">
        <p>{!! $service->description !!}</p>
    </div>
    <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Inquiry Now
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title fw-bold text-primary" id="exampleModalLabel">Inquiry Form</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('service-inquiry') }}" method="post" id="serviceEnquiryForm">
                        <input type="text" name="service_id" value="{{ $service->id }}" hidden />
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
    $('#serviceEnquiryForm').validate({
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
</script>
@endsection