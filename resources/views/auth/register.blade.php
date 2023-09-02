<!DOCTYPE html>

        <html class="loading" lang="en" data-textdirection="ltr">
          <!-- BEGIN: Head-->
          <head>
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
            <meta name="description" content="Materialize is a Material Design Admin Template,It's modern, responsive and based on Material Design by Google.">
            <meta name="keywords" content="materialize, admin template, dashboard template, flat admin template, responsive admin template, eCommerce dashboard, analytic dashboard">
            <meta name="author" content="ThemeSelect">
            <title> Register | Admin</title>
            <link rel="apple-touch-icon" href="{{ asset('backend/assets/images/favicon/apple-touch-icon-152x152.png') }}">
            <link rel="shortcut icon" type="image/x-icon" href="{{ asset('backend/assets/images/favicon/favicon-32x32.png') }}">
            <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
            <!-- BEGIN: VENDOR CSS-->
            <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/vendors/vendors.min.css') }}">
            <!-- END: VENDOR CSS-->
            <!-- BEGIN: Page Level CSS-->
            <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/themes/vertical-modern-menu-template/materialize.css') }}">
            <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/themes/vertical-modern-menu-template/style.css') }}">
            <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/pages/register.css') }}">
            <!-- END: Page Level CSS-->
            <!-- BEGIN: Custom CSS-->
            <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/custom/custom.css') }}">
            <!-- END: Custom CSS-->
          </head>
          <!-- END: Head-->

          <body class="vertical-layout vertical-menu-collapsible page-header-dark vertical-modern-menu preload-transitions 1-column   blank-page blank-page" data-open="click" data-menu="vertical-modern-menu" data-col="1-column">
            <div class="row">
              <div class="col s12">
                <div class="container">
                  <div id="register-page" class="row">
          <div class="col s12 m6 l4 card-panel border-radius-6 register-card bg-opacity-8 pt-3">

            <!-- <form method="POST" action="{{ route('register') }}" class="login-form"> -->

    <form method="POST" action="{{ route('register') }}" class="login-form">
        @csrf
      <div class="row margin">
        <div class="input-field col s12">
          <i class="material-icons prefix pt-2">account_circle</i>
          <input id="name"  type="text" name="name" required autofocus />
          <label for="name" class="center-align" :value="__('Name')">Name</label>
        </div>
              @error('name')
              <small class="errorTxt3  red-text">{{ $message }}*</small>
              @enderror  
      </div>
      <div class="row margin">
        <div class="input-field col s12">
          <i class="material-icons prefix pt-2">person_outline</i>
          <input id="username" type="text" name="username" :value="old('username')" required  autocomplete="username">
          <label for="username" class="center-align">Username</label>
        </div>
              @error('username')
              <small class="errorTxt3  red-text">{{ $message }}*</small>
              @enderror  
      </div>
      <div class="row margin">
        <div class="input-field col s12">
          <i class="material-icons prefix pt-2">mail_outline</i>
          <input id="email"  type="email" name="email" :value="old('email')" required autocomplete="email">
          <label for="email">Email</label>
        </div>
              @error('email')
              <small class="errorTxt3  red-text">{{ $message }}*</small>
              @enderror 
      </div>
      <div class="row margin">
        <div class="input-field col s12">
          <i class="material-icons prefix pt-2">lock_outline</i>
          <input id="password" type="password" autocomplete="new-password" name="password" required>
          <label for="password">Password</label>
        </div>
              @error('password')
              <small class="errorTxt3  red-text">{{ $message }}*</small>
              @enderror 
      </div>
      <div class="row margin">
        <div class="input-field col s12">
          <i class="material-icons prefix pt-2">lock_outline</i>
          <input id="password_confirmation" type="password" name="password_confirmation" required>
          <label for="password_confirmation">Password Confirmation</label>
        </div>
              @error('password_confirmation')
              <small class="errorTxt3  red-text">{{ $message }}*</small>
              @enderror 
      </div>
      
      <div class="row pl-5 pr-5">
        <div class="input-field right">
          <button class="btn-large waves-effect waves-light" onclick="ShowPreloader()">{{ __('Register') }}</button>
        </div>
      </div>
              <div class="progress collection">
                <div id="preloader" class="indeterminate"  style="display:none; 
                border:2px #ebebeb solid"></div>
              </div>
      <div class="row">
        <div class="input-field col s12">
          <p class="margin medium-small"><a href="{{ route('login') }}">Already have an account? Login</a></p>
        </div>
      </div>
    </form>
          </div>
        </div>
                </div>
                <div class="content-overlay"></div>
              </div>
            </div>

            <!-- BEGIN VENDOR JS-->
            <script src="{{ asset('backend/assets/js/vendors.min.js') }}"></script>
            <!-- BEGIN VENDOR JS-->
            <!-- BEGIN PAGE VENDOR JS-->
            <!-- END PAGE VENDOR JS-->
            <!-- BEGIN THEME  JS-->
            <script src="{{ asset('backend/assets/js/plugins.js') }}"></script>
            <script src="{{ asset('backend/assets/js/search.js') }}"></script>
            <script src="{{ asset('backend/assets/js/custom/custom-script.js') }}"></script>
            <!-- END THEME  JS-->
            <!-- BEGIN PAGE LEVEL JS-->
            <!-- END PAGE LEVEL JS-->
    <script type='text/javascript'>
      function ShowPreloader() {
        document.getElementById('preloader').style.display = "block";
      }
    </script>
          </body>
        </html> 