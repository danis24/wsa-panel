<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'LaraBot') }}</title>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/4.7.95/css/materialdesignicons.min.css" rel="stylesheet">
    <link href="{{ asset('css/themes/vendor.bundle.base.css') }}" rel="stylesheet">
    <link href="{{ asset('css/themes/vendor.bundle.addons.css') }}" rel="stylesheet">
    <link href="{{ asset('css/themes/style.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">        
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo" href="index.html"><img src="../../images/logo.svg" alt="logo"/></a>
        <a class="navbar-brand brand-logo-mini" href="index.html"><img src="../../images/logo-mini.svg" alt="logo"/></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="mdi mdi-menu"></span>
        </button>
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
              <img src="../../images/faces/face5.jpg" alt="profile"/>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item">
                <i class="mdi mdi-settings text-primary"></i>
                Settings
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item">
                <i class="mdi mdi-logout text-primary"></i>
                Logout
              </a>
            </div>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <router-link to="/home" class="nav-link">
              <i class="mdi mdi-view-dashboard-outline menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link to="/trade" class="nav-link">
              <i class="mdi mdi-finance menu-icon"></i>
              <span class="menu-title">Trading Bot</span>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link to="/settings" class="nav-link">
              <i class="mdi mdi-codepen menu-icon"></i>
              <span class="menu-title">Settings</span>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link to="/accounts" class="nav-link">
              <i class="mdi mdi-account-outline menu-icon"></i>
              <span class="menu-title">Account</span>
            </router-link>
          </li>
          <li class="nav-item">
            <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              <i class="mdi mdi-logout menu-icon"></i>
              <span class="menu-title">Logout</span>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
          </li>
        </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
            <router-view></router-view>
        </div>
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
</div>

<script src="{{ asset('js/themes/vendor.bundle.base.js') }}"></script>
<script src="{{ asset('js/themes/vendor.bundle.addons.js') }}"></script>
<script src="{{ asset('js/themes/off-canvas.js') }}"></script>
<script src="{{ asset('js/themes/hoverable-collapse.js') }}"></script>
<script src="{{ asset('js/themes/template.js') }}"></script>
<script src="{{ asset('js/themes/settings.js') }}"></script>
<script src="{{ asset('js/themes/todolist.js') }}"></script>
<script src="{{ asset('js/themes/dashboard.js') }}"></script>
  
</body>
</html>
