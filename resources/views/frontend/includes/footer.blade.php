<!-- --------------------------------footer starts --------------------------------------- -->
<footer>

    <!-- footer -->
    <div class="bg-yellow p-1 mt-5"></div>
    <div class="bg-footer py-4 text-white fw-5 fs-5 font-poppins">
        <div class="container my-2">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-12">
                    @if(!empty($site_settings['footer_logo']))
                    <a href="{{ route('home') }}">
                    <div class="img-logo">
                        <img src="{{ imageexist($site_settings['footer_logo']) }}" class="img-fluid">
                    </div>
                    </a>
                    @endif
                    @if(!empty($site_settings['site_description']))
                    <p style="text-align: justify;" class="fs-6">{{ $site_settings[ 'site_description' ] }}</p>
                    @endif
                </div>
                <div class="col-lg-3 col-md-6 col-12 text-capitalize d-flex justify-content-start justify-content-lg-center">
                    <ul class="lh-lg">
                        <a class="text-decoration-none text-white" href="{{ route('home') }}"><li>Home</li></a>
                        <a class="text-decoration-none text-white" href="{{ route('about') }}"><li>about us</li></a>
                        <a class="text-decoration-none text-white" href="{{ route('services') }}"><li>services</li></a>
                        <a class="text-decoration-none text-white" href="{{ route('products') }}"><li>products</li></a>
                        <a class="text-decoration-none text-white" href="{{ route('testimonials') }}"><li>testimonials</li></a>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 col-12 text-capitalize">
                    <ul class="lh-lg">
                        <a class="text-decoration-none text-white" href="{{ route('privacy-policy') }}"><li>privacy policy</li></a>
                        <a class="text-decoration-none text-white" href="{{ route('news') }}"><li>news</li></a>
                        <a class="text-decoration-none text-white" href="{{ route('offers') }}"><li>offer</li></a>
                        <a class="text-decoration-none text-white" href="{{ route('terms-of-service') }}"><li>terms of service</li></a>
                        <a class="text-decoration-none text-white" href="{{ route('contact') }}"><li>contact us</li></a>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 col-12 text-capitalize">
                    @if(!empty($site_settings['phone']))
                    <p>Mobile: {{ $site_settings['phone'] }}</p>
                    @endif

                    @if(!empty($site_settings['email']))
                    <p>Email ID: {{ $site_settings['email'] }}</p>
                    @endif

                    @if(!empty($site_settings['address']))
                    <p>Address: {{ $site_settings['address'] }}</p>
                    @endif

                    <div class="d-flex mt-3 ft-icons">
                        @if(!empty($site_settings['instagram_link']))
                        <a href="{{ $site_settings[ 'instagram_link' ] }}" target="_blank">
                            <div class="rounded-circle px-2 py-1 bg-light mx-2"><i class="bi bi-instagram text-darkft"></i></div>
                        </a>
                        @endif
                        @if(!empty($site_settings['facebook_link']))
                        <a href="{{ $site_settings[ 'facebook_link' ] }}" target="_blank">
                            <div class="rounded-circle px-2 py-1 bg-light mx-2"><i class="bi bi-facebook text-darkft"></i></div>
                        </a>
                        @endif
                        @if(!empty($site_settings['twitter_link']))
                        <a href="{{ $site_settings[ 'twitter_link' ] }}" target="_blank">
                            <div class="rounded-circle px-2 py-1 bg-light mx-2"><i class="bi bi-twitter text-darkft"></i></div>
                        </a>
                        @endif
                        @if(!empty($site_settings['youtube_link']))
                        <a href="{{ $site_settings[ 'youtube_link' ] }}" target="_blank">
                            <div class="rounded-circle px-2 py-1 bg-light mx-2"><i class="bi bi-youtube text-darkft"></i></div>
                        </a>
                        @endif
                        @if(!empty($site_settings['linkedin_link']))
                        <a href="{{ $site_settings[ 'linkedin_link' ] }}" target="_blank">
                            <div class="rounded-circle px-2 py-1 bg-light mx-2"><i class="bi bi-linkedin text-darkft"></i></div>
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="text-muted p-3 text-center">
        &copy; 2024 Prince Mobile All rights reserved | Designed & Devloped by <a href="https://adiyogitechnosoft.com/" target="_blank" class="text-muted text-decoration-none">Adiyogi Technosoft Pvt. Ltd.</a>
    </div>
</footer>