 @extends('admin.admin_master')
  @section('vendor_styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/vendors/data-tables/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/vendors/data-tables/extensions/responsive/css/responsive.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/vendors/data-tables/css/select.dataTables.min.css') }}">
  @endsection
  @section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/pages/data-tables.css') }}">
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
              <div class="col s10 m6 l6">
                <h5 class="breadcrumbs-title mt-0 mb-0"><span>Hi, {{ getUserName() }}</span></h5>
                <ol class="breadcrumbs mb-0">
                  <li class="breadcrumb-item"><a href="#!">Here is 
                  @role('admin') the @endrole 
                  @role('recorder') your @endrole
                financial overview/activities for the year {{ getCurrentYear() }}</a>
                  </li>
                </ol>
              </div>

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
      <div class="col s12 m6 l4 card-width">
        <div class="card border-radius-6">
          <div class="card-content center-align">
            <i class="material-icons green-text small-ico-bg mb-5">add_circle</i>
            <p class="green-text  mt-3">Add Donation</p>
          </div>
        </div>
      </div>
    </a>

    <!-- Add Modal Here -->
    @include('admin.dashboard.modals.add-donation-form')

      <a href="#!">
      <div class="col s12 m6 l4 card-width">
        <div class="card border-radius-6">
          <div class="card-content center-align">
            <i class="material-icons blue-text small-ico-bg mb-5">person_add</i>
            <p class="blue-text  mt-3">Register Donor</p>
          </div>
        </div>
      </div>
    </a>

    <!-- Add Modal Here -->

      @role('admin')
    <a class="modal-trigger" href="#add-expense-modal">
      <div class="col s12 m6 l4 card-width">
        <div class="card border-radius-6">
          <div class="card-content center-align">
            <i class="material-icons red-text small-ico-bg mb-5">add_circle</i>
            <p class="red-text  mt-3">Add Expense</p>
          </div>
        </div>
      </div>
    </a>
      @endrole

    <!-- Add Modal Here -->
    @include('admin.dashboard.modals.add-expense-form')

      
    </div>
<div class="divider"></div>

    <!-- Add Table Here -->
    <div class="section section-data-tables">
    @include('admin.dashboard.unverified-donation-table')
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
  @endsection