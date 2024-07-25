 <!-- BEGIN: SideNav -->
@php

$route = Route::current()->getName()

@endphp  
    <aside class="sidenav-main nav-expanded nav-lock nav-collapsible sidenav-light sidenav-active-square">
      <div class="brand-sidebar">
        <h1 class="logo-wrapper">
          <a class="brand-logo darken-1" href="{{route('dashboard')}}">
          <img style="padding-bottom: 0.2em; height: 1.3em;" class="hide-on-med-and-down" src="{{ asset('backend/assets/images/logo/recordia_bg_logo.png') }}" alt="recordia logo"/>
          <img style="margin-top: -8px; height: 1.3em;" class="show-on-medium-and-down hide-on-med-and-up" src="{{ asset('backend/assets/images/logo/recordia_bg_logo.png') }}" alt="recordia logo"/><span class="logo-text hide-on-med-and-down"><img src="{{ asset('backend/assets/images/logo/recordia_text.png') }}"  style="height: 1.5em;" /></span>
        </a>
        <a class="navbar-toggler" href="#">
          <i class="material-icons">radio_button_checked</i>
        </a>
      </h1>
      </div>
      <ul class="sidenav sidenav-collapsible leftside-navigation collapsible sidenav-fixed menu-shadow" id="slide-out" data-menu="menu-navigation" data-collapsible="menu-accordion">

        <li class="active bold"><a class="{{ ($route == 'dashboard')? 'active' : '' }} waves-effect waves-cyan " href="{{ route('dashboard') }}"><i class="material-icons">dashboard</i><span class="menu-title" data-i18n="Dashboard">Dashboard</span></a>
        </li>
        {{--@role('admin')--}}
        <li class="navigation-header"><a class="navigation-header-text">Records </a><i class="navigation-header-icon material-icons">more_horiz</i>
        </li>
        <li class="bold">
          <a class="collapsible-header waves-effect waves-cyan " href="JavaScript:void(0)">
          <i class="material-icons">view_agenda</i>
            <span class="menu-title" data-i18n="Instant Records">Instant Records</span>
          </a>
          <div class="collapsible-body">
            <ul class="collapsible collapsible-sub" data-collapsible="accordion">
              <li>
                <a class="{{ ($route == 'get.instant.records')? 'active' : '' }} waves-effect waves-cyan" href="{{  route('get.instant.records')}}"><i class="material-icons">radio_button_unchecked</i>
                  <span data-i18n="All Records">All Records</span>
                </a>
              </li> 
              <li>
                <a class="{{ ($route == 'instant.verified.donations')? 'active' : '' }} waves-effect waves-cyan" href="{{  route('instant.verified.donations')}}"><i class="material-icons">radio_button_unchecked</i>
                  <span data-i18n="Verified Donations">Verified Donations</span>
                </a>
              </li>
              <li>
                <a class="{{ ($route == 'instant.unverified.donations')? 'active' : '' }} waves-effect waves-cyan" href="{{  route('instant.unverified.donations')}}"><i class="material-icons">radio_button_unchecked</i>
                  <span data-i18n="Verified Donations">Unverified Donations</span>
                </a>
              </li> 
              <li>
                <a class="{{ ($route == 'instant.unpaid.donations')? 'active' : '' }} waves-effect waves-cyan" href="{{  route('instant.unpaid.donations')}}"><i class="material-icons">radio_button_unchecked</i>
                  <span data-i18n="Pledges">Pledges</span>
                </a>
              </li> 
              <li>
                <a class="{{ ($route == 'get.expenses')? 'active' : '' }} waves-effect waves-cyan" href="{{  route('get.expenses')}}"><i class="material-icons">radio_button_unchecked</i>
                  <span data-i18n="All Expenses">All Expenses</span>
                </a>
              </li>               
            </ul>
          </div>
        </li>

        <li class="bold">
          <a class="collapsible-header waves-effect waves-cyan " href="JavaScript:void(0)">
          <i class="material-icons">dns</i>
            <span class="menu-title" data-i18n="Registered Records">Registered Records</span>
          </a>
          <div class="collapsible-body">
            <ul class="collapsible collapsible-sub" data-collapsible="accordion">
              <li>
                <a class="{{ ($route == 'get.registered.records')? 'active' : '' }} waves-effect waves-cyan" href="{{  route('get.registered.records')}}"><i class="material-icons">radio_button_unchecked</i>
                  <span data-i18n="All Records">All Records</span>
                </a>
              </li>
              <li>
                <a class="{{ ($route == 'registered.verified.donations')? 'active' : '' }} waves-effect waves-cyan" href="{{  route('registered.verified.donations')}}"><i class="material-icons">radio_button_unchecked</i>
                  <span data-i18n="Verified Donations">Verified Donations</span>
                </a>
              </li> 
              <li>
                <a class="{{ ($route == 'registered.unverified.donations')? 'active' : '' }} waves-effect waves-cyan" href="{{  route('registered.unverified.donations')}}"><i class="material-icons">radio_button_unchecked</i>
                  <span data-i18n="Verified Donations">Unverified Donations</span>
                </a>
              </li>              
              <li>
                <a class="{{ ($route == 'registered.unpaid.donations')? 'active' : '' }} waves-effect waves-cyan" href="{{  route('registered.unpaid.donations')}}"><i class="material-icons">radio_button_unchecked</i>
                  <span data-i18n="Pledges">Pledges</span>
                </a>
              </li> 
            </ul>
          </div>
        </li>
        <li class="navigation-header"><a class="navigation-header-text">Settings</a><i class="navigation-header-icon material-icons">more_horiz</i>
        </li>

        
        <li class="bold">
          <a class="collapsible-header waves-effect waves-cyan " href="JavaScript:void(0)">
          <i class="material-icons">settings</i>
            <span class="menu-title" data-i18n="Registered Records">Configuration</span>
          </a>
          <div class="collapsible-body">
            <ul class="collapsible collapsible-sub" data-collapsible="accordion">
              <li>
                <a class="{{ ($route == 'manage.year')? 'active' : '' }} waves-effect waves-cyan" href="{{  route('manage.year')}}"><i class="material-icons">radio_button_unchecked</i>
                  <span data-i18n="Manage Year">Manage Year</span>
                </a>
              </li>

              <li>
                <a class="{{ ($route == 'manage.event')? 'active' : '' }} waves-effect waves-cyan" href="{{  route('manage.event')}}"><i class="material-icons">radio_button_unchecked</i>
                  <span data-i18n="Manage Event">Manage Event</span>
                </a>
              </li> 

              <li>
                <a class="{{ ($route == 'manage.donor')? 'active' : '' }} waves-effect waves-cyan" href="{{  route('manage.donor') }}"><i class="material-icons">radio_button_unchecked</i>
                  <span data-i18n="Manage Event">Manage Donor</span>
                </a>
              </li>            
            </ul>
          </div>
        </li>

        <li class="navigation-header"><a class="navigation-header-text">Users & Permissions </a><i class="navigation-header-icon material-icons">more_horiz</i>
        </li>

        
        <li class="bold">
          <a class="collapsible-header waves-effect waves-cyan " href="JavaScript:void(0)">
          <i class="material-icons">group</i>
            <span class="menu-title" data-i18n="Registered Records">User</span>
          </a>
          <div class="collapsible-body">
            <ul class="collapsible collapsible-sub" data-collapsible="accordion">
              <li>
                <a class="{{ ($route == 'manage.year')? 'active' : '' }} waves-effect waves-cyan" href="{{  route('manage.year')}}"><i class="material-icons">radio_button_unchecked</i>
                  <span data-i18n="Manage Year">All Users</span>
                </a>
              </li>

              <li>
                <a class="{{ ($route == 'manage.permission')? 'active' : '' }} waves-effect waves-cyan" href="{{  route('manage.permission') }}"><i class="material-icons">radio_button_unchecked</i>
                  <span data-i18n="Manage Event">Permissions</span>
                </a>
              </li> 

              <li>
                <a class="{{ ($route == 'manage.role')? 'active' : '' }} waves-effect waves-cyan" href="{{  route('manage.role')}}"><i class="material-icons">radio_button_unchecked</i>
                  <span data-i18n="Manage Event">Roles</span>
                </a>
              </li>            
            </ul>
          </div>
        </li>
        {{--@endrole--}}
      </ul>
      <!-- <div class="navigation-background"></div> -->
      <a class="sidenav-trigger btn-sidenav-toggle btn-floating btn-medium waves-effect waves-light hide-on-large-only" href="#" data-target="slide-out"><i class="material-icons">menu</i></a>


    </aside>
    <!-- END: SideNav