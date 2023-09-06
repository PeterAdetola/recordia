<!-- BEGIN: Header-->
    <header class="page-topbar" id="header">
      <div class="navbar navbar-fixed"> 
        <nav class="navbar-main navbar-color nav-collapsible sideNav-lock navbar-dark gradient-45deg-indigo-purple no-shadow">
          <div class="nav-wrapper">

            <div class="header-search-wrapper hide-on-med-and-down"><i class="material-icons">search</i>
              <input class="header-search-input z-depth-2" type="text" name="Search" placeholder="Explore Recordia" data-search="template-list">
              <ul class="search-list collection display-none"></ul>
            </div>
            <ul class="navbar-list right">

              <!-- <li class="hide-on-med-and-down pt-4"><a class="  btn-large waves-effect tooltipped waves-block waves-light" href="{{ ('/create/year') }}" data-position="bottom" data-tooltip="Create a new year"><i class="material-icons">date_range</i></a></li> -->
              <li><a class="waves-effect waves-block waves-light notification-button" href="javascript:void(0);" data-target="dropdown"><i class="material-icons">date_range</i></a></li>


              <li class="hide-on-large-only search-input-wrapper"><a class="waves-effect waves-block waves-light search-button" href="javascript:void(0);"><i class="material-icons">search</i></a></li>
              
              <li><a class="waves-effect waves-block waves-light profile-button" href="javascript:void(0);" data-target="profile-dropdown"><b class="btn-floating  center waves-effect waves-light gradient-45deg-purple-deep-orange" >PA</b></a></li>
            </ul>
            <!-- notifications-dropdown-->
            <ul class="dropdown-content" id="dropdown">
              
              <!-- <li class="divider"></li> -->
              <li><a href="{{ ('/create/year/event') }}" class="black-text"><span class="material-icons icon-bg-circle grey small">add</span> Create Year/Events</a>
                
              </li>

            </ul>
            <!-- profile-dropdown-->
            <ul class="dropdown-content" id="profile-dropdown">
              <li><a class="grey-text text-darken-1" href="{{route('profile.edit')}}"><i class="material-icons">person_outline</i> Profile</a></li>
              <li class="divider"></li>
              <form method="POST" action="{{ route('logout') }}">
                            @csrf
              <li>
                <a class="grey-text text-darken-1" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                              <i class="material-icons">keyboard_tab</i> Logout</a></li>
              </form>



            </ul>
          </div>
          <nav class="display-none search-sm">
            <div class="nav-wrapper">
              <form id="navbarForm">
                <div class="input-field search-input-sm">
                  <input class="search-box-sm mb-0" type="search" required="" id="search" placeholder="Explore Materialize" data-search="template-list">
                  <label class="label-icon" for="search"><i class="material-icons search-sm-icon">search</i></label><i class="material-icons search-sm-close">close</i>
                  <ul class="search-list collection search-list-sm display-none"></ul>
                </div>
              </form>
            </div>
          </nav>
        </nav>
      </div>
    </header>
    <!-- END: Header-->