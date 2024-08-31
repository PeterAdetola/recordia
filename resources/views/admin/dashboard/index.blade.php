 @extends('admin.admin_master')
 @php
$adminAccess = ['create donation', 'create donor', 'create expense'];

$displayEventDonation = checkDonationDisplay()->first()->display_donations_by_event;

$noEvent = $displayEventDonation === 0 || getCurrentEvent() === 'No event';

  

 @endphp
  @section('vendor_styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/vendors/data-tables/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/vendors/data-tables/extensions/responsive/css/responsive.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/vendors/data-tables/css/select.dataTables.min.css') }}">
  @endsection
  @section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/pages/data-tables.css') }}">
<style>
    /* Add margin for footer address */
@media (min-width: 992px) {
  .description {
    margin-top: -1.5em;
  }
}
@media (max-width: 767px) {
  .description {
    margin-top: 1.5em;
  }
  .main-text{
    font-size: 0.8em;
  }
}
</style>
  @endsection
 @section('admin')
    <!-- BEGIN: Page Main-->
    <div id="main">
      <div class="row">
        <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
        <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
          <!-- Search for small screen-->
          <div class="container">
            <div class="row">
              <div class="col s10 m6 l8 description">
                <h5 class="breadcrumbs-title mt-0 mb-0">
                  <span class="main-text">Financial overview/activities for {{ $noEvent ? 'the year '.getCurrentYear() : getCurrentEventName().'-'.getCurrentYear() }}</span></h5>
               
                <ol class="breadcrumbs mb-0">
                  <li class="breadcrumb-item">
                    @role('admin')
                    <a href="{{ route('manage.event') }}"><span class="chip white-text indigo darken-4">Event</span>
                      @else<span class="chip white-text indigo darken-4">Event</span>
                    @endrole
                    </a>
                      @if (getCurrentEvent() == 'No event')
                      <span class="chip indigo-text darken-4 white">No event</span>
                      @else
                      <span class="chip indigo-text darken-4 white">{{ getCurrentEventName() }}</span>
                      @endif
                  </li>
                </ol>
              </div>
              @role('admin')
              <div class="col s2 m6 l4">
                <a class="modal-trigger mb-2 btn-floating btn-flat waves-effect waves-light breadcrumbs-btn right"  data-position="left" data-tooltip="activate multiple donors" style="margin-top: -10px" href="#config_overview-modal" ><i class="material-icons hide-on-med-and-up">settings</i><i class="material-icons right">settings</i>
                </a>
              </div>
      @include('admin.dashboard.modals.config_overview-modal')
              @endrole

            </div>
          </div>
        </div>
        <div class="col s12">
          <div class="container">
    <div class="section">
      <!-- Add Financial Overview Here -->
    @include('admin.dashboard.financial-overview')
    </div>

<div class="divider"></div>

    <div class="row">

      <a class="modal-trigger" href="#add-donation-modal">
      <!-- <div class="col s12 m6 l4 card-width"> -->
      <div class="col {{ auth()->user()->can('create expense') ? 's12 m6 l4' : 's12 m6' }} card-width">
        <div class="card border-radius-6">
          <div class="card-content center-align">
            <i class="material-icons green-text small-ico-bg mb-5">add_circle</i>
            <p class="green-text  mt-3">Add Donation</p>
          </div>
        </div>
      </div>
    </a>

    <!-- Add Modal Here -->
    @if (getCurrentEvent() == 'No event')
      @include('admin.dashboard.modals.add-ins-donation-form')
    @else
      @include('admin.dashboard.modals.add-reg-donation-form')
    @endif

      <a class="modal-trigger" href="#add-donor-modal">
      <div class="col {{ auth()->user()->can('create expense') ? 's6 m4 l4' : 's12 m6' }}  card-width">
        <div class="card border-radius-6">
          <div class="card-content center-align">
            <i class="material-icons blue-text small-ico-bg mb-5">person_add</i>
            <p class="blue-text  mt-3">Register Donor</p>
          </div>
        </div>
      </div>
    </a>
    @include('admin.dashboard.modals.add-donor-form')

  @can('create expense')
    <a class="modal-trigger" href="#add-expense-modal">
      <div class="col s6 m4 l4 card-width">
        <div class="card border-radius-6">
          <div class="card-content center-align">
            <i class="material-icons red-text small-ico-bg mb-5">add_circle</i>
            <p class="red-text  mt-3">Add Expense</p>
          </div>
        </div>
      </div>
    </a>
    @include('admin.dashboard.modals.add-expense-form')
  @endcan

      
    </div>
<div class="divider"></div>

    <!-- Add Table Here -->
    <div class="section section-data-tables">
    @include('admin.dashboard.recent-donation-table')
    </div>


      </div>
    </div>
  </div>
</section>


          </div>
          <!-- <div class="content-overlay"></div> -->
        </div>
      </div>
    </div>
    <!-- END: Page Main-->
  @endsection
  @section('vendor_scripts')
    <script src="{{ asset('backend/assets/vendors/data-tables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/assets/vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('backend/assets/vendors/data-tables/js/dataTables.select.min.js') }}"></script>
  @endsection
  @section('scripts')
    <script src="{{ asset('backend/assets/js/custom/dashboard-script.js') }}"></script>
    <script type="text/javascript">
      

      // Preloader Script
      function ShowPreloader() {
        document.getElementById('preloader').style.display = "block";
        document.getElementById('preloader2').style.display = "block";
        document.getElementById('preloader3').style.display = "block";
        // document.getElementById('preloader4').style.display = "block";
      }
    </script>
  @endsection