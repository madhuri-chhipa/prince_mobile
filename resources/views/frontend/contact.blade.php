@extends('frontend.layouts.app')
@section('header_scripts')
<style>
    /* Adjusting image size */
    .contact-image {
        max-width: 100%;
        max-height: 500px;
    }

    .error {
        color: red;
    }

    /* Style for the container */
    .contact-container {
        background-color: #f8f9fa;
        border-radius: 10px;
    }

    /* Style for the form */
    .contact-form {
        background-color: #ffffff;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }

    /* Style for the submit button */
    .btn-submit {
        background-color: #007bff;
        border-color: #007bff;
    }

    .btn-submit:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }
</style>
@endsection
@section('content')
<div class="bg-blue py-4">
    <div class="container">
        <nav aria-label="breadcrumb" class="my-auto">
            <ol class="breadcrumb my-auto">
                <li class="breadcrumb-item fs-4"><a href="{{ route('home') }}" class="text-light fw-bold">Home</a></li>
                <li class="breadcrumb-item fs-4 active text-light fw-bold" aria-current="page">Contact Us</li>
            </ol>
        </nav>
    </div>
</div>
<div class="container contact-container pt-5">
    <div class="row">
        <div class="col-md-6">
            <!-- Half page image -->
            <img src="{{ imageexist('public/assets/frontend/images/about.png') }}" alt="Contact Image" class="img-fluid rounded contact-image">
        </div>
        <div class="col-md-6">
            <!-- Half page form -->
            <div class="contact-form">
                <h4 class="fw-bold fs-4 text-secondary mb-3">Contact Us</h4>
                <form action="{{ route('contact.submit') }}" method="post" id="contactForm">
                    {{ csrf_field() }}
                    <div class="mb-3">
                        <label for="fullName" class="form-label">Full Name</label>
                        <input type="text"  placeholder="Enter Your Name" name="name" class="form-control" id="fullName" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" placeholder="Enter Your Email Address"  name="email" class="form-control" id="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Mobile</label>
                        <input type="phone" placeholder="Enter Your Mobile No."  name="phone" class="form-control" id="phone" required>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Message</label>
                        <textarea class="form-control" name="message" placeholder="Enter Your Message" id="message" rows="4" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary btn-submit btn-lg">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('footer_scripts')
<script>
    $(document).ready(function() {
        $('#contactForm').validate({
            rules: {
                fullname: {
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
                fullname: {
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
    });
</script>
@if(Session::has('success'))
<script type="text/javascript">
    function message() {
        Swal.fire(
            'Thankyou for submission.',
            '',
            'success'
        );
    }
    window.onload = message;
</script>
@endif
@endsection