  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="{{ route('admin.dashboard') }}">
        <img src="{{ asset($site_settings['logo']) }}" alt="{{ $site_settings['application_name'] }}" class="img-fluid mt-2">
        <span class="brand-text font-weight-light">&nbsp;</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
          <!-- Sidebar user panel (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
              <div class="image">
                  @if (Auth::guard('admin')->check())
                  <img src="{{ asset(Auth::guard('admin')->user()->image) }}" class="img-circle elevation-2" alt="User Image">
                  <span class="brand-text font-weight-light col-white">&nbsp;{{ Auth::guard('admin')->user()->name }}</span>
                  @endif
              </div>
              <div class="info">
                  <a href="#" class="d-block"></a>
              </div>
          </div>



          @php
          $active1 = $active2 = $active3 = $active4 = $active5 = $active6 = $active7 = $active8 = $active9 = $active10 = $active11 = $active12 = $active13 = $active14 = $active15 = $active16 = '';
          $fullpage = url()->current();
          $fullpage = explode('/', $fullpage);

          if (in_array('dashboard', $fullpage)) {
          $active1 = 'active';
          }

          $sidemenu = ['role', 'banner','testimonial', 'cms', 'home_cms', 'testimonials'];
          foreach ($sidemenu as $menukey => $menuvalue) {
          if (in_array($menuvalue, $fullpage)) {
          $active2 = 'active';
          }
          if (in_array('role', $fullpage)) {
          $a21 = 'active';
          }
          if (in_array('banner', $fullpage)) {
          $a22 = 'active';
          }
          if (in_array('testimonial', $fullpage)) {
          $a33 = 'active';
          }

          if (in_array('cms', $fullpage)) {
          $a23 = 'active';
          }
          if (in_array('home_cms', $fullpage)) {
          $a24 = 'active';
          }
          if (in_array('testimonials', $fullpage)) {
          $a25 = 'active';
          }

          }

          $sidemenu = ['blog_categories', 'blog'];
          foreach ($sidemenu as $menukey => $menuvalue) {
          if (in_array($menuvalue, $fullpage)) {
          $active18 = 'active';
          }
          if (in_array('blog_categories', $fullpage)) {
          $a81 = 'active';
          }
          if (in_array('blog', $fullpage)) {
          $a82 = 'active';
          }
          }


          $sidemenu = ['categories', 'product'];
          foreach ($sidemenu as $menukey => $menuvalue) {
          if (in_array($menuvalue, $fullpage)) {
          $active4 = 'active';
          }
          if (in_array('categories', $fullpage)) {
          $a31 = 'active';
          }
          if (in_array('product', $fullpage)) {
          $a32 = 'active';
          }
          }


          if (in_array('booking_inquires', $fullpage)) {
          $active8 = 'active';
          }

          if (in_array('product', $fullpage)) {
          $active5 = 'active';
          }

          if (in_array('subadmin', $fullpage)) {
          $active7 = 'active';
          }

          if (in_array('testimonials', $fullpage)) {
          $active9 = 'active';
          }

          $sidemenu = ['countries', 'states', 'cities','area'];
          foreach ($sidemenu as $menukey => $menuvalue) {
          if (in_array($menuvalue, $fullpage)) {
          $active10 = 'active';
          }
          if (in_array('countries', $fullpage)) {
          $a101 = 'active';
          }
          if (in_array('states', $fullpage)) {
          $a102 = 'active';
          }
          if (in_array('cities', $fullpage)) {
          $a103 = 'active';
          }
          if (in_array('area', $fullpage)) {
          $a104 = 'active';
          }
          }



          if (in_array('general_inquires', $fullpage)) {
          $active13 = 'active';
          }

          if (in_array('certificate', $fullpage)) {
          $active15 = 'active';
          }


          if (in_array('general_settings', $fullpage)) {
          $active16 = 'active';
          }
          @endphp

          <!-- Sidebar Menu -->
          <nav class="mt-2">
              <ul class="nav nav-pills nav-sidebar  flex-column" data-widget="treeview" role="menu" data-accordion="false">

                  <li class="nav-item">
                      <a href="{{ route('admin.dashboard') }}" class="nav-link {{ $active1 }}">
                          <i class="nav-icon fas fa-tachometer-alt"></i>
                          <p> Dashboard </p>
                      </a>
                  </li>

                  @if (userCan(103))
                  <li class="nav-item">
                      <a href="{{ url('admin/subadmin') }}" class="nav-link {{ @$active7 }}">
                          <i class="nav-icon fas fa-user"></i>
                          <p> Sub Admin </p>
                      </a>
                  </li>
                  @endif
                  @if (userCan([104,105,106,107,112,117,118,119]))
                  <li class="nav-item {{ @$active2 }} {{ @$active2 ? 'menu-open' : '' }}">
                      <a href="#" class="nav-link {{ @$active2 }}">
                          <i class="nav-icon fas fa-cog"></i>
                          <p> Masters <i class="fas fa-angle-left right"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          @if (userCan(104))
                          <li class="nav-item">
                              <a href="{{ url('admin/role') }}" class="nav-link {{ @$a21 }}">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Role</p>
                              </a>
                          </li>
                          @endif
                          @if (userCan(105))
                          <li class="nav-item">
                              <a href="{{ url('admin/banner') }}" class="nav-link {{ @$a22 }}">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Banners</p>
                              </a>
                          </li>
                          @endif

                          @if (userCan(118))
                          <li class="nav-item">
                              <a href="{{ url('admin/offer') }}" class="nav-link {{ @$a22 }}">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Offers</p>
                              </a>
                          </li>
                          @endif

                          @if (userCan(106))
                          <li class="nav-item">
                              <a href="{{ url('admin/cms') }}" class="nav-link {{ @$a23 }}">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Cms</p>
                              </a>
                          </li>
                          @endif
                          @if (userCan(107))
                          <li class="nav-item">
                              <a href="{{ url('admin/home_cms') }}" class="nav-link {{ @$a24 }}">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Home Cms</p>
                              </a>
                          </li>
                          @endif

                          @if (userCan(117))
                          <li class="nav-item">
                              <a href="{{ url('admin/news') }}" class="nav-link {{ @$a25 }}">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>News/Events</p>
                              </a>
                          </li>
                          @endif

                          @if (userCan(119))
                          <li class="nav-item">
                              <a href="{{ url('admin/manufactures') }}" class="nav-link {{ @$active5 }}">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Manufactures</p>
                              </a>
                          </li>
                          @endif

                          @if (userCan(112))
                          <li class="nav-item">
                              <a href="{{ url('admin/testimonials') }}" class="nav-link {{ @$a25 }}">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Testimonials </p>
                              </a>
                          </li>
                          @endif
                      </ul>
                  </li>
                  @endif
                  @if (userCan([109,114,115]))
                  <li class="nav-item {{ @$active4 }} {{ @$active4 ? 'menu-open' : '' }}">
                      <a href="#" class="nav-link {{ @$active4 }}">
                          <i class="fa fa-tags  nav-icon"></i>
                          <p> Catalog <i class="fas fa-angle-left right"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          @if (userCan(114))
                          <li class="nav-item">
                              <a href="{{url('admin/categories')}}" class="nav-link <?= @$a31 ?>">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Category</p>
                              </a>
                          </li>
                          @endif

                          @if (userCan(109))
                          <li class="nav-item">
                              <a href="{{ url('admin/product') }}" class="nav-link {{ @$active5 }}">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Products </p>
                              </a>
                          </li>
                          @endif

                          @if (userCan(115))
                          <li class="nav-item">
                              <a href="{{ url('admin/services') }}" class="nav-link {{ @$active5 }}">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>services </p>
                              </a>
                          </li>
                          @endif
                      </ul>
                  </li>
                  @endif

                  @if (userCan(111))
                  <li class="nav-item">
                      <a href="{{ url('admin/booking_inquires') }}" class="nav-link {{ @$active8 }}">
                          <i class="fas fa-envelope nav-icon"></i>
                          <p>Product Inquires </p>
                      </a>
                  </li>
                  @endif

                  @if (userCan(116))
                  <li class="nav-item">
                      <a href="{{ url('admin/service_inquiries') }}" class="nav-link {{ @$active13 }}">
                          <i class="fas fa-envelope nav-icon"></i>
                          <p>Service Inquiries </p>
                      </a>
                  </li>
                  @endif

                  @if (userCan(110))
                  <li class="nav-item">
                      <a href="{{ url('admin/general_inquires') }}" class="nav-link {{ @$active13 }}">
                          <i class="fas fa-envelope nav-icon"></i>
                          <p>General Inquires </p>
                      </a>
                  </li>
                  @endif
              </ul>
          </nav>
          <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
  </aside>