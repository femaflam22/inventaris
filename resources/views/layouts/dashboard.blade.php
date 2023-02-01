<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Inventaris Dashboard</title>
  <link rel="shortcut icon" href="{{asset('assets/img/logo.png')}}" type="image/x-icon">
  <!-- base:css -->
  <link rel="stylesheet" href="{{asset('assets/global/dashboard/vendors/mdi/css/materialdesignicons.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/global/dashboard/vendors/css/vendor.bundle.base.css')}}">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{asset('assets/global/dashboard/css/style.css')}}">
</head>
<body>
  <div class="container-scroller d-flex">
    <!-- partial:./partials/_sidebar.html -->
    <nav class="sidebar sidebar-offcanvas" id="sidebar" style="background-img: url('{{asset('assets/global/dashboard/images/other/navbar-cover.jpg')}}') center center no-repeat">
      {{-- cek role : admin --}}
      <ul class="nav">
        <li class="nav-item sidebar-category">
          <p>Menu</p>
          <span></span>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('dashboard')}}">
            <i class="mdi mdi-view-quilt menu-icon"></i>
            <span class="menu-title">Dashboard</span>
          </a>
        </li>
        @if (Auth::user()->role == 'admin')
        <li class="nav-item sidebar-category">
          <p>Items Data</p>
          <span></span>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('admin.categories.index')}}">
            <i class="mdi mdi-view-headline menu-icon"></i>
            <span class="menu-title">Categories</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('admin.items.index')}}">
            <i class="mdi mdi-chart-pie menu-icon"></i>
            <span class="menu-title">Items</span>
          </a>
        </li>
        {{-- <li class="nav-item">
          <a class="nav-link" href="{{route('admin.repairs.index')}}">
            <i class="mdi mdi-calendar menu-icon"></i>
            <span class="menu-title">Repair Items</span>
          </a>
        </li> --}}
        <li class="nav-item sidebar-category">
          <p>Accounts</p>
          <span></span>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
            <i class="mdi mdi-account menu-icon"></i>
            <span class="menu-title">Users</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="auth">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item"> <a class="nav-link" href="{{route('admin.users.accounts.index')}}"> Admin </a></li>
              <li class="nav-item"> <a class="nav-link" href="{{route('admin.users.operators')}}"> Operator </a></li>
            </ul>
          </div>
        </li>
      </ul>
      @elseif(Auth::user()->role == 'operator')

      {{-- cek role : operator --}}
        <li class="nav-item sidebar-category">
          <p>Items Data</p>
          <span></span>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('operator.items')}}">
            <i class="mdi mdi-chart-pie menu-icon"></i>
            <span class="menu-title">Items</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('operator.lendings.index')}}">
            <i class="mdi mdi-autorenew menu-icon"></i>
            <span class="menu-title">Lending</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
            <i class="mdi mdi-account menu-icon"></i>
            <span class="menu-title">Users</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="auth">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item"> <a class="nav-link" href="{{route('users.accounts.edit', Auth::user()->id)}}"> Edit </a></li>
            </ul>
          </div>
        </li>
      @endif
      </ul>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:./partials/_navbar.html -->
      <nav class="navbar col-lg-12 col-12 px-0 py-0 py-lg-4 d-flex flex-row">
        <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
          </button>
          <div class="navbar-brand-wrapper">
            <a class="navbar-brand brand-logo" href="index.html"><img src="{{asset('assets/img/logo.png')}}" alt="logo" width="50"/></a>
            <a class="navbar-brand brand-logo-mini" href="index.html"><img src="{{asset('assets/img/logo.png')}}" width="20" alt="logo"/></a>
          </div>
          <h4 class="font-weight-bold mb-0 d-none d-md-block mt-1 text-capitalize">Welcome back, {{Auth::user()->name}}</h4>
          <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item">
              <h4 class="mb-0 font-weight-bold d-none d-xl-block">{{\Carbon\Carbon::now()->format('j F, Y')}}</h4>
            </li>
          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
          </button>
        </div>
        <div class="navbar-menu-wrapper navbar-search-wrapper d-none d-lg-flex align-items-center">
          <ul class="navbar-nav mr-lg-2">
            <li class="nav-item nav-search d-none d-lg-block">
              <div class="input-group">
                <input type="text" class="form-control" placeholder="Check menu in sidebar" aria-label="search" aria-describedby="search" disabled>
              </div>
            </li>
          </ul>
          <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item nav-profile dropdown">
              <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" id="profileDropdown">
                <img src="{{asset('assets/img/user.png')}}" alt="profile"/>
                <span class="nav-profile-name text-capitalize">{{Auth::user()->name}}</span>
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                <a class="dropdown-item" href="{{route('logout')}}">
                  <i class="mdi mdi-logout text-primary"></i>
                  Logout
                </a>
              </div>
            </li>
          </ul>
        </div>
      </nav>

      @yield('content')
      <!-- partial -->
      <div class="main-panel">
        <!-- partial:./partials/_footer.html -->
        <footer class="footer">
          <div class="card">
            <div class="card-body">
              <div class="d-sm-flex justify-content-center justify-content-sm-between py-2">
                <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © <a href="https://www.bootstrapdash.com/" target="_blank">bootstrapdash.com </a>2021</span>
                <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Inventaris Management of <a href="https://www.bootstrapdash.com/" target="_blank"> SMK Wikrama Bogor</a></span>
              </div>
            </div>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- base:js -->
  <script src="{{asset('assets/global/dashboard/vendors/js/vendor.bundle.base.js')}}"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <script src="{{asset('assets/global/dashboard/vendors/chart.js/Chart.min.js')}}"></script>
  <script src="{{asset('assets/global/dashboard/js/jquery.cookie.js')}}" type="text/javascript"></script>
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="{{asset('assets/global/dashboard/js/off-canvas.js')}}"></script>
  <script src="{{asset('assets/global/dashboard/js/hoverable-collapse.js')}}"></script>
  <script src="{{asset('assets/global/dashboard/js/template.js')}}"></script>
  <!-- endinject -->
  <!-- plugin js for this page -->
    <script src="{{asset('assets/global/dashboard/js/jquery.cookie.js')}}" type="text/javascript"></script>
  <!-- End plugin js for this page -->
  <!-- Custom js for this page-->
  <script src="{{asset('assets/global/dashboard/js/dashboard.js')}}"></script>
  <!-- End custom js for this page-->

  <script src="{{asset('assets/global/landing-page/vendors/jquery/jquery.min.js')}}"></script>
  @yield('js')
</body>

</html>