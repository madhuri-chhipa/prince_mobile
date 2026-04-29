<header>
  <div class="bg-lightgray py-2">
    <div class="container">
      <div class="row">
        <div class="col-sm-6">
          <div class="row d-flex flex-md-row flex-column">
            <div class="col-xl-4 col-md-6 d-flex align-items-center justify-content-sm-start justify-content-center">
              @if(!empty($site_settings['phone']))
              <i class="bi bi-telephone-fill mx-2"></i>
              <small class="fw-6">{{ $site_settings[ 'phone' ] }}</small>
              @endif
            </div>
            <div class="col-xl-8 col-md-6 d-flex align-items-center justify-content-sm-start justify-content-center">
              @if(!empty($site_settings['email']))
              <i class="bi bi-envelope-fill mx-2"></i>
              <small class="fw-6">{{ $site_settings[ 'email' ] }}</small>
              @endif
            </div>
          </div>
        </div>
        <div class="col-sm-6 d-flex justify-content-sm-end justify-content-center align-items-center ft-icons">
          @if(!empty($site_settings['instagram_link']))
          <a href="{{ $site_settings[ 'instagram_link' ] }}" target="_blank">
            <div class="rounded-circle px-2 py-1 bg-secondary mx-1"><i class="bi bi-instagram text-lightgray"></i></div>
          </a>
          @endif
          @if(!empty($site_settings['facebook_link']))
          <a href="{{ $site_settings[ 'facebook_link' ] }}" target="_blank">
            <div class="rounded-circle px-2 py-1 bg-secondary mx-1"><i class="bi bi-facebook text-lightgray"></i></div>
          </a>
          @endif
          @if(!empty($site_settings['twitter_link']))
          <a href="{{ $site_settings[ 'twitter_link' ] }}" target="_blank">
            <div class="rounded-circle px-2 py-1 bg-secondary mx-1"><i class="bi bi-twitter text-lightgray"></i></div>
          </a>
          @endif
          @if(!empty($site_settings['youtube_link']))
          <a href="{{ $site_settings[ 'youtube_link' ] }}" target="_blank">
            <div class="rounded-circle px-2 py-1 bg-secondary mx-1"><i class="bi bi-youtube text-lightgray"></i></div>
          </a>
          @endif
          @if(!empty($site_settings['linkedin_link']))
          <a href="{{ $site_settings[ 'linkedin_link' ] }}" target="_blank">
            <div class="rounded-circle px-2 py-1 bg-secondary mx-1"><i class="bi bi-linkedin text-lightgray"></i></div>
          </a>
          @endif
        </div>
      </div>
    </div>
  </div>
  <nav class="navbar navbar-expand-lg bg-dark p-0" id="navbar_top">
    <div class="container">
      @if(!empty($site_settings['logo']))
      <a class="navbar-brand" href="{{ route('home') }}">
        <div class="img-logo">
          <img src="{{ imageexist($site_settings['logo']) }}" class="img-fluid" alt="">
        </div>
      </a>
      @endif
      <button class="navbar-toggler bg-light px-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="offcanvas offcanvas-end bg-dark" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
        <div class="offcanvas-header">
          @if(!empty($site_settings['logo']))
          <a class="navbar-brand" href="{{ route('home') }}">
            <div class="img-logo">
              <img src="{{ imageexist($site_settings['logo']) }}" class="img-fluid" alt="">
            </div>
          </a>
          @endif
          <button type="button" class="btn-close bg-light" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0 fw-6">
            <li class="nav-item mx-xl-4 mx-2 px-2 fs-5 py-lg-0 py-2">
              <a class="nav-link py-0 active text-light" aria-current="page" href="{{ route('home') }}">Home</a>
            </li>
            <li class="nav-item mx-xl-4 mx-2 px-2 fs-5 py-lg-0 py-2">
              <a class="nav-link py-0 text-light" href="{{ route('about') }}">About Us</a>
            </li>
            <li class="nav-item mx-xl-4 mx-2 px-2 fs-5 py-lg-0 py-2">
              <a class="nav-link py-0 text-light" href="{{ route('products') }}">Products</a>
            </li>
            <li class="nav-item mx-xl-4 mx-2 px-2 fs-5 py-lg-0 py-2">
            <div class="dropdown">
              <a class="dropbtn bg-dark text-white text-decoration-none">Services</a>
              <div class="dropdown-content">
                @foreach ($site_settings['services'] as $key => $service)
                  <a href="{{ route('services',['service_slug' => $key]) }}" class="fs-6 fw-bold text-capitalize">{{ $service }} <i class="bi bi-arrow-right text-primary" aria-hidden="true"></i></a>
                @endforeach
              </div>
            </div>
              <!-- <a class="nav-link py-0 text-light" href="{{ route('services') }}">Services</a> -->
            </li>
            <li class="nav-item mx-xl-4 mx-2 px-2 fs-5 py-lg-0 py-2">
              <a class="nav-link py-0 text-light" href="{{ route('contact') }}">Contact Us</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>

  <!-- <nav class="navbar navbar-expand-lg p-0 bg-dark">
    <div class="container">
      <a class="navbar-brand" href="#">
        <div class="img-logo">
          <img src="{{ asset('\public\assets\frontend\images\logo.png') }}" class="img-fluid" alt="">
        </div>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0 fw-6">
          <li class="nav-item mx-xl-4 mx-2 px-2 fs-5">
            <a class="nav-link py-0 active text-light" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item mx-xl-4 mx-2 px-2 fs-5">
            <a class="nav-link py-0 text-light" href="#">About Us</a>
          </li>
          <li class="nav-item mx-xl-4 mx-2 px-2 fs-5">
            <a class="nav-link py-0 text-light" href="#">Products</a>
          </li>
          <li class="nav-item mx-xl-4 mx-2 px-2 fs-5">
            <a class="nav-link py-0 text-light" href="#">Services</a>
          </li>
          <li class="nav-item mx-xl-4 mx-2 px-2 fs-5">
            <a class="nav-link py-0 text-light" href="#">Contact Us</a>
          </li>
        </ul>
      </div>
    </div>
  </nav> -->
</header>