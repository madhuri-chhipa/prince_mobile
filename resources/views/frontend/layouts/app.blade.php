<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>
    <link rel="icon" type="image/x-icon" href="{{ $site_settings['favicon'] }}" />
    <link rel="stylesheet" href="{{ asset('public\assets\frontend\css\style.css') }}">
    <link rel="stylesheet" href="{{ asset('public\assets\frontend\css\bootstrap.min.css')}}">
    <link href="{{ asset('public\assets\frontend\css\css2.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('public\assets\frontend\css\bootstrap-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public\assets\frontend\css\owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public\assets\frontend\css\owl.theme.default.min.css') }}">
    <title>@yield('title', '')</title>
    <meta name="keywords" content="@yield('meta_keyword', $site_settings['meta_keyword'])">
    <meta name="description" content="@yield('meta_description', $site_settings['meta_description'])">

    <meta name="site_url" content="{{ url('/') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @yield('header_scripts')

</head>

<body>
    <div class="nav-position ">
        @include('frontend.includes.header')
    </div>

    <div class="content-margin">
        @yield('content')
    </div>

    @include('frontend.includes.footer')

    <script src="{{ asset('public\assets\frontend\js\jquery.min.js') }}"></script>
    <script src="{{ asset('public\assets\frontend\js\bootstrap.min.js') }}" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script> -->
    <script src="{{ asset('public\assets\frontend\js\owl.carousel.min.js') }}"></script>
    <script src="{{ asset('public\assets\frontend\js\sweetalert2.min.js') }}"></script>
    <script src="{{ asset('public\assets\frontend\js\sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('public\assets\frontend\js\jquery.validate.min.js') }}"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            window.addEventListener('scroll', function() {
                if (window.scrollY > 50) {
                    document.getElementById('navbar_top').classList.add('fixed-top');
                    // add padding top to show content behind navbar
                    navbar_height = document.querySelector('.navbar').offsetHeight;
                    document.body.style.paddingTop = navbar_height + 'px';
                } else {
                    document.getElementById('navbar_top').classList.remove('fixed-top');
                    // remove padding top from body
                    document.body.style.paddingTop = '0';
                }
            });
        });
        
    </script>
    @yield('footer_scripts')
</body>

</html>