    <!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
  <!-- BEGIN: Head-->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Recordia is a portfolio project for Holberton School which is meant for financial secretaries who want to give almost instant financial reports to the organization they work with and give instant invoice to the donors.">
    <meta name="keywords" content="balance, payments, expenses, accountind dashboard, analytic dashboard">
    <meta name="author" content="Pacmedia Creatives">
    <title> Recordia | verify email</title>
    <link rel="apple-touch-icon" href="{{ asset('backend/assets/images/favicon/recordia-apple-touch-icon-152x152.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('backend/assets/images/favicon/favicon-32x32.png') }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- BEGIN: VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/vendors/vendors.min.css') }}">
    <!-- END: VENDOR CSS-->
    <!-- BEGIN: Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/themes/vertical-modern-menu-template/materialize.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/themes/vertical-modern-menu-template/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/pages/login.css') }}">
    <!-- END: Page Level CSS-->
    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/custom/custom.css') }}">
    <!-- END: Custom CSS-->
<style type="text/css">
  form:invalid button {
   pointer-events: none;
   /*opacity: .8;*/
}
</style>
  </head>
  <!-- END: Head-->
  <body class="vertical-layout vertical-menu-collapsible page-header-dark vertical-modern-menu preload-transitions 1-column  login-bg    blank-page blank-page" data-open="click" data-menu="vertical-modern-menu" data-col="1-column">
    <div class="row">
      <div class="col s12">
        <div class="container">
          
          <div id="login-page" class="row">
  <div class="col s12 m6 l4" style="margin: auto;">
            <div class="flex justify-center" style="width:5em; margin: auto;">
      <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
       viewBox="0 0 100 100" style="enable-background:new 0 0 100 100;" xml:space="preserve">
        <style type="text/css">
          .st0{fill:#FFFFFF;}
          .st1{fill:#E94581;}
        </style>
        <g>
          <path class="st0" d="M49.7,73.7V24.3v-1.7H48H21.2h-1.7v1.7v3.6v1.7h1.7h7.1V79v1.7H30h27.5h1.7V79v-3.6v-1.7h-1.7
            C57.5,73.7,49.7,73.7,49.7,73.7z M42.7,29.5v44.2h-7.5V29.5H42.7z"/>
          <path class="st0" d="M66.6,22.3c-8.4,0-15.4,6.9-15.4,15.4c0,8.4,6.9,15.4,15.4,15.4S82,46.2,82,37.7S75.1,22.3,66.6,22.3z
             M75,37.7c0,4.7-3.8,8.4-8.4,8.4s-8.4-3.8-8.4-8.4s3.8-8.4,8.4-8.4S75,33.1,75,37.7z"/>
        </g>
        <rect class="st1" width="100" height="100"/>
        <g>
          <path class="st0" d="M48,73V21.4v-1.8h-1.8H18.3h-1.8v1.8v3.8V27h1.8h7.4v51.6v1.8h1.8h28.8h1.8v-1.8v-3.8V73h-1.8H48z M40.8,73.1
            H33V26.9h7.8V73.1z"/>
          <path class="st0" d="M56.1,20.1c0,0.3,0,0.6,0,1c0,15,12.1,27.1,27.1,27.1c0.1,0,0.2,0,0.3,0V20.1H56.1z M76.8,40.4
            c-6.3-2.1-11.2-7.2-13.1-13.6h13.1V40.4z"/>
        </g>
    </svg>
            </div>
    <!-- Session Status -->
    <div class=" card-panel border-radius-6 login-card bg-opacity-8">
    <x-auth-session-status class="mb-4" :status="session('status')" />
      <div class="row collection" style="padding:1em">
        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
      </div>      

    @if (session('status') == 'verification-link-sent')
      <div class="row collection" style="padding:1em">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </div>
    @endif
    <form method="POST" action="{{ route('login') }}">
        @csrf
      <div class="row pl-5 pr-5">
        <div class="input-field right">
          <button class="btn-large waves-effect waves-light"  onclick="ShowPreloader()">{{ __('Resend Verification Email') }}</button>
        </div>
      </div>
    </form>

              <div class="progress collection">
                <div id="preloader" class="indeterminate"  style="display:none; 
                border:2px #ebebeb solid"></div>
              </div>

      <div class="row justify-center">        

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="btn-flat waves-effect waves-light">
                {{ __('Log Out') }}
            </button>
        </form>
  </div>
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