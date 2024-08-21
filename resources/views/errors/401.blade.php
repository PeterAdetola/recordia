    <!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
  <!-- BEGIN: Head-->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Pacmedia Creatives is an agency for business startup and solution proferin solution agency taking your ideal from imagination to reality">
    <meta name="keywords" content="balance, payments, expenses, accountind dashboard, analytic dashboard">
    <meta name="author" content="Pacmedia Creatives">
    <title> Webitor | Unauthorized</title>
    <link rel="apple-touch-icon" href="{{ asset('backend/assets/images/favicon/icon.png') }}">
    
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('backend/assets/images/favicon/icon_bg.png') }}">
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

     .align-btn {
      display: flex;
      align-items: center;
    }
  form:invalid button {
   pointer-events: none;
   /*opacity: .8;*/
}
</style>
  </head>
  <!-- END: Head-->
  <body class="vertical-layout vertical-menu-collapsible page-header-dark vertical-modern-menu preload-transitions 1-column login-bg blank-page blank-page" data-open="click" data-menu="vertical-modern-menu" data-col="1-column">
    <div class="row">
      <div class="col s12">
        <div class="container">
          
          <div id="login-page" class="row">
  <div class="col s12 m6 l4" style="margin: auto;">
      <div class="flex justify-center" style="width:5em; margin: auto;">
        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 101.5 101.5" style="enable-background:new 0 0 101.5 101.5;" xml:space="preserve">
              <defs><style>.cls-1{fill:#1c1c1c;}</style></defs><path class="cls-1" d="M0,0V92.7H92.7V0ZM44.13,85.55,25.84,68.33V48.91H44.13Zm0-40.42H25.84V24l18.29-4.59ZM66.44,63.74,48.15,66V48.91H66.44Zm0-18.61H48.15V26.91l18.29,2.87Z"/>
        </svg>
      </div>
    <!-- Session Status -->
    <div class="card border-radius-6 bg-opacity-8" style="padding: 4em ;">
      <div style="height: 5em;">
  <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
   viewBox="0 0 285.2 99.1" style="enable-background:new 0 0 285.2 99.1;" xml:space="preserve">
<style type="text/css">
  .four01{fill:#EBEBEB;}
</style>
<g>
  <path class="four01" d="M106.3,69.5v13.8h-14v13.8H78.5V83.4H0v-5.8L92.3,0v69.5H106.3z M78.5,69.5V29.8L31.3,69.5H78.5z"/>
  <path class="four01" d="M215.8,7c9.3,4.6,16.4,10.7,21.2,18.3c4.7,7.5,7.1,15.5,7.1,24.1c0,8.6-2.4,16.7-7.1,24.1c-4.7,7.6-11.8,13.8-21.2,18.5
    c-9.5,4.7-20.8,7-34,7c-13.1,0-24.4-2.3-33.9-7c-9.3-4.6-16.4-10.7-21.2-18.3c-4.7-7.6-7.1-15.6-7.1-24.1c0-8.7,2.4-16.8,7.1-24.3
    c4.8-7.6,11.9-13.8,21.2-18.3c9.5-4.7,20.8-7,33.9-7C194.8,0,206.2,2.3,215.8,7z M181.7,14c-10.2,0-19,1.7-26.4,5
    c-7.3,3.3-12.8,7.6-16.6,13.2c-3.7,5.4-5.5,11.2-5.5,17.4c0,4.7,1.1,9.3,3.4,13.7c2.2,4.4,5.5,8.3,9.9,11.6l57.6-57.5
    C197.6,15.1,190.1,14,181.7,14z M181.7,85.2c10.3,0,19.2-1.7,26.6-5c7.2-3.3,12.7-7.6,16.5-13.2c3.7-5.4,5.5-11.2,5.5-17.4
    c0-4.7-1.1-9.3-3.4-13.8c-2.3-4.5-5.6-8.4-9.9-11.6l-57.6,57.6C166.5,84.1,173.9,85.2,181.7,85.2z"/>
  <path class="four01" d="M285.2,1.1v96.2h-14V28.8h-13.8L285.2,1.1z"/>
</g>
</svg>

      </div>
           <h1 class="card-title">Unauthorized!!</h1>
<p>Sorry,  Access to the requested resource is unauthorized.</p> 
<div class="divider mb-4"></div>
<a href="{{ route('dashboard') }}" class="ml-2 align-btn"><i class="small-ico-bg material-icons grey-text mb-0">arrow_back</i><span class="chip" style="margin-top: 5px;">Let's go back home</span></a>
    </div>
  <div class="row center">Made with <span style="color:red">&#10084;</span> by Pacmedia Creatives</div>
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