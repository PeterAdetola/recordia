<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <title>Recordia | Record diary for event donations</title>

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="{{ asset('frontend/assets/css/materialize.css') }}" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="{{ asset('frontend/assets/css/style.css') }}" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<body style="font-size: 1.1em;">
  <div class="">
  <nav class="white" role="navigation">
    <div class="nav-wrapper container">
      <a id="logo-container" href="#" class="brand-logo" style="width: 50px; margin-top: 5px;">
        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
   viewBox="0 0 101.5 101.5" style="enable-background:new 0 0 101.5 101.5;" xml:space="preserve">
          <style type="text/css">
            .st0{fill:#E94581;}
            .st1{fill:#FFFFFF;}
          </style>
          <path class="st0" d="M69.8,101.5H31.7C14.2,101.5,0,87.3,0,69.8V31.7C0,14.2,14.2,0,31.7,0h38.2c17.5,0,31.7,14.2,31.7,31.7v38.2
            C101.5,87.3,87.3,101.5,69.8,101.5z"/>
          <g>
            <path class="st1" d="M51.5,77V19.7v-2h-2h-31h-2v2v4.2v2h2h8.2v57.3v2h2h31.9h2v-2V79v-2h-2H51.5z M43.4,25.8v51.3h-8.7V25.8H43.4z
              "/>
            <path class="st1" d="M71.1,17.4c-9.8,0-17.9,8-17.9,17.9c0,9.8,8,17.9,17.9,17.9S89,45.1,89,35.3C89,25.4,81,17.4,71.1,17.4z
               M80.9,35.3c0,5.4-4.4,9.8-9.8,9.8c-5.4,0-9.8-4.4-9.8-9.8c0-5.4,4.4-9.8,9.8-9.8C76.5,25.5,80.9,29.9,80.9,35.3z"/>
          </g>
        </svg>
      </a>
      <ul class="right hide-on-med-and-down">
        <li><a href="#about">About</a></li>
        <li><a href="#features">Features</a></li>
        <li><a href="#developer">Developer</a></li>
            @if (Route::has('login'))
                    @auth
        <li><a class="chip red red-text lighten-4" href="{{ url('/dashboard') }}">Dashboard</a></li>
                    @else
        <li><a class="chip red red-text lighten-4" href="{{ route('login') }}">Log in</a></li>

                        @if (Route::has('register'))
        <li><a class="chip red red-text lighten-4" href="{{ route('register') }}">Register</a></li>
                        @endif
                    @endauth
            @endif
      </ul>

     
            @if (Route::has('login'))
      <ul id="mobile-demo" class="side-nav">
                    @auth
        <li><a class="red-text" href="{{ url('/dashboard') }}">Dashboard</a></li>
                    @else
        <li><a class="red-text" href="{{ route('login') }}">Log in</a></li>

                        @if (Route::has('register'))
        <li><a class="red-text" href="{{ route('register') }}">Register</a></li>
                        @endif
                    @endauth
      </ul>
            @endif
      <a href="#" data-activates="mobile-demo" class="red-text button-collapse"><i class="material-icons">menu</i></a>
    </div>
  </nav>
</div>

  <div id="index-banner" class="parallax-container">
    <div class="section no-pad-bot">
      <div class="container">
        <br><br>
        <h1 class="header center white-text text-lighten-2">Recordia</h1>
        <div class="row center">
          <h5 class="header col s12">Record diary for event donations</h5>
        </div>
        <div class="row center">
          <a href="{{ route('register') }}" id="download-button" class="btn-large waves-effect waves-light red accent-3 lighten-1">Get Started</a>
        </div>
        <br><br>

      </div>
    </div>
    <div class="parallax"><img src="{{ asset('frontend/assets/background1.jpg') }}" alt="Unsplashed background img 1"></div>
  </div>

 <div class="container">
    <div class="section">

      <div id="about" class="row">
        <div class="col s12 m4">
          <div class="icon-block">
            <h2 class="center red-text"><i class="material-icons">flash_on</i></h2>
            <h5 class="center">Speeds up accounting</h5>

            <p class="center">Recordia does most of the heavy lifting for you to provide a smooth accounting operation.</p>
          </div>
        </div>

        <div class="col s12 m4">
          <div class="icon-block">
            <h2 class="center red-text"><i class="material-icons">group</i></h2>
            <h5 class="center">User Experience Focused</h5>

            <p class="center">Grants permission to users based on their various roles</p>
          </div>
        </div>

        <div class="col s12 m4">
          <div class="icon-block">
            <h2 class="center red-text"><i class="material-icons">settings</i></h2>
            <h5 class="center">Easy to work with</h5>

            <p class="center">Removes the hassles of paper and calculator thereby giving smooth accounting</p>
          </div>
        </div>
      </div>
      <div class="divider"></div>
      <div class="row">
        <div class="col s12 center">
          <h3><i class="mdi-content-send red-text"></i></h3>
          <h4>About Recordia</h4>
          <p class="left-align">Recordia is a portfolio project for <a class="red-text" href="https://www.holbertontulsa.com/">Holberton School</a> which is meant for financial secretaries who want to give almost instant financial reports to the organization they work with and give instant invoice to the donors. I got the inspiration for this app based on my experience with a non-profit organization that does launching and events for the purpose of raising funds. </p>
          <p class="left-align">During the launching, donors are allowed to buy items(launching items) and proper records are taken for all launching and items purchased. Some pay in cash, some transfers while some pledges their support. At the end of the event, partakers will have their invoice prepared to know the summation of how much was paid and amount pledged for them to reconcile.</p>
          
        </div>
      </div>

    </div>
  </div>



  <div class="parallax-container valign-wrapper">
    <div class="section no-pad-bot">
      <div class="container">
        <div class="row center">
          <h5 class="header col s12 light">Remove the hazzle of manual calculation with calculator and paper</h5>
        </div>
      </div>
    </div>
    <div class="parallax"><img src="{{ asset('frontend/assets/background2.jpg') }}" alt="Unsplashed background img 2"></div>
  </div>

 

  <div class="container">
    <div class="section">

      <!--   Icon Section   -->
      <div class="row">
        <div class="col s12 m6">
          <img src="{{ asset('frontend/assets/laptop.png') }}" style="height: 25em;" >
        </div>

        <div class="col s12 m6">
          <p class="left-align" style="margin-top:5em"><b>The main challenge is that the process of getting the invoice prepared has always been hectic and prone to errors.</b> Recordia is meant to automate the process of invoice preparation, getting it ready on request to be sent to the participant’s email or preferably their whatsapp numbers in a pdf format thereby ensuring a transparent invoice preparation. And also, give an on sight analysis of the total amount raised which will be the amount in cash, amount in transfer and total amount pledged waiting for reconciliation.</p>
        </div>
      </div>

    </div>
  </div>


  <div id="features" class="parallax-container valign-wrapper">
    <div class="section no-pad-bot">
      <div class="container">
        
    <div class="col s12 card-content-link">
      <div class="card z-depth-0 card-border-gray pb-3">
        <div class="card-content">
          <div class="row">
            <div class="col s12">
              <h5 class="black-text"><i class="material-icons red-text vertical-text-bottom"> grade </i> Features</h5>
              <br>
            </div>
            <div class="col s12 m6">
              <p class="grey-text">Automate the process of invoice preparation</p>
              <div class="divider"></div>
              <p class="grey-text">On sight analysis of the total amount raised</p>
              <div class="divider"></div>
              <p class="grey-text">Personalized interface for donors</p>
            </div>
            <div class="col s12 m6">
              <p class="grey-text">Control flexibilty in role permission</p>
              <div class="divider"></div>
              <p class="grey-text">Generatd invoice received on email/whatsapp</p>
              <div class="divider"></div>
              <p class="grey-text">Daily, weekly, monthly and Annual financial statement</p>
            </div>
          </div>
        </div>
      </div>
    </div>
      </div>
    </div>
    <div class="parallax"><img src="{{ asset('frontend/assets/background3.jpg') }}" alt="Unsplashed background img 3"></div>
  </div>

  <footer class="page-footer grey darken-3">
    <div class="container">
      <div id="developer" class="row">
        <div class="col l6 s12">
          <h5 class="grey-text lighten-1" style="font-size:1.2em">About the Developer</h5>
          <p class="grey-text text-lighten-4 light">Peter Adetola is a fullstack software engineer of alx software engineering program working on this project and this project is still a work in progress, stay tuned for updates.</p>


        </div>
        <div class="col l3 s12">
          <h5 class="grey-text lighten-1" style="font-size:1.2em">Navigator</h5>
          <ul>
            <li><a class="white-text light" href="#!">About</a></li>
            <li><a class="white-text light" href="#!">Features</a></li>
            <li><a class="white-text light" href="#!">Developer</a></li>
          </ul>
        </div>
        <div class="col l3 s12">
          <h5 class="grey-text lighten-1" style="font-size:1.2em">User Access</h5>
     
          <ul>
            @if (Route::has('login'))
                    @auth
            <li><a class="white-text" href="{{ route('dashboard') }}">Dashboard</a></li>
                    @else
            <li><a class="white-text" href="{{ route('login') }}">Log in</a></li>

                        @if (Route::has('register'))
            <li><a class="white-text" href="{{ route('register') }}">Register</a></li>
                        @endif
                    @endauth
            @endif
          </ul>
        </div>
      </div>
    </div>
    <div class="footer-copyright grey darken-4">
      <div class="container">
      Made by <a class="grey-text text-lighten-1" href="http://github.com/PeterAdetola">Peter Adetola</a>
      </div>
    </div>
  </footer>


  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="{{ asset('frontend/assets/js/materialize.js') }}"></script>
  <script src="{{ asset('frontend/assets/js/init.js') }}"></script>

  </body>
</html>
