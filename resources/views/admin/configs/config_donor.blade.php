@extends('admin.admin_master')
 @section('admin')
  @section('vendor_styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/vendors/data-tables/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/vendors/data-tables/extensions/responsive/css/responsive.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/vendors/data-tables/css/select.dataTables.min.css') }}">
  @endsection
  @section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/pages/data-tables.css') }}">
  @endsection

@php
$pageTitle = 'Registered Donors';
@endphp


    <!-- BEGIN: Page Main-->
    <div id="main">
      <div class="row">
        <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
        <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
          <!-- Search for small screen-->
          <div class="container">
            <div class="row">
              <div class="col s10 m6 l6">
                <h5 class="breadcrumbs-title mt-0 mb-0">
                  <span>{{ $pageTitle }}</span>
                </h5>
                <ol class="breadcrumbs mb-0">
                  <li class="breadcrumb-item"><a  href="{{ route('dashboard') }}">Dashboard</a></li>
                  <li class="breadcrumb-item active">{{ $pageTitle }}</li>
                </ol>
              </div>
              <!-- <div class="col s2 m6 l6">
                <a class="btn tooltipped mb-2 btn-floating btn-flat waves-effect waves-light breadcrumbs-btn right"  data-position="left" data-tooltip="activate multiple donors" href="{{  route('activate.donors')}}" ><i class="material-icons hide-on-med-and-up">playlist_add_check</i><i class="material-icons right">playlist_add_check</i>
                </a>
              </div> -->
            </div>
          </div>
        </div>
        <div class="col s12">
          <div class="container">
            <div class="section section-data-tables">
              
              <!-- Content Here -->

  <!-- DataTables Row grouping -->
  <div class="row">
    <div class="col s12 m12 l12">
      <div id="" class="card card card-default scrollspy">
        <div class="card-content">
          <div class="row">
            <h4 class="card-title left ml-2">{{ $pageTitle }}</h4>
            <a href="{{ route('activate.donors') }}"><span class="right chip"><b style="color: maroon;">&nbsp;Edit Donors <i class="material-icons right mt-8" style="font-size: 1.2em;">navigate_next</i></b></span></a>
          </div>
          <div class="row">
            <div class="col s12">
              <br/>
              <div class="divider"></div>
            </div>
            <div class="col s12">
              <table id="data-table-simple" class="display">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Phone</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>

                <tbody>
                @foreach ($donors as $donor) 
                  <tr>
                    <td>{{ $donor->title }} {{ $donor->name }}</td>

                    <td>{{ $donor->username }} </td>

                    <td>{{ $donor->phone }}</td>

                    @if($donor->status == 1)
                    <td><span class="chip green-text">active</span></td>
                    @else
                    <td><span class="chip red-text">inactive</span></td>
                    @endif

                    <td>
                      @if($donor->donationCount() > 0)
                      <a href="{{ route('donor.donation', $donor->id) }}" class="notification-button btn-floating mb-1 btn-flat waves-effect waves-light grey lighten-2">
                        <i class="material-icons blue-text">more_horiz</i>
                      </a>
                      @else
                      <a href="{{ route('donor.donation', $donor->id) }}" class="btn-floating mb-1 btn-flat waves-effect waves-light grey lighten-2">
                        <i class="material-icons grey-text">more_horiz</i>
                      </a>
                      @endif

                      
                      <a href="#{{ $donor->id }}" class="modal-trigger btn-floating mb-1 btn-flat waves-effect waves-light grey lighten-2">
                        <i class="material-icons grey-text">edit</i>
                      </a>
                    </td>
                  </tr>

        <!-- Table Modal here -->

    @include('admin.configs.modals.edit-donor-form') 

        <!-- /Donation info ends -->
                @endforeach
                </tbody>

                <tfoot>
                  <tr>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Phone</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </tfoot>
              </table>

              
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

              <!-- Content ends Here -->
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- END: Page Main-->
  <div style="bottom: 50px; right: 19px;" class="fixed-action-btn"><a href="#add-donor-modal" class="modal-trigger btn-floating btn-large gradient-45deg-purple-deep-orange gradient-shadow"><i class="material-icons">add</i></a>
  </div>

    <!-- Add Modal Here -->
    @include('admin.dashboard.modals.add-donor-form')

@endsection
  @section('vendor_scripts')
    <script src="{{ asset('backend/assets/vendors/data-tables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/assets/vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('backend/assets/vendors/data-tables/js/dataTables.select.min.js') }}"></script>
  @endsection
@section('scripts')
  <!-- <script src="{{ asset('backend/assets/js/plugins.js') }}"></script> -->
  <script src="{{ asset('backend/assets/js/scripts/data-tables.js') }}"></script>

  <script>

    document.getElementById("submitDonorBtn").addEventListener("click", function() {
      var preloader = document.getElementById("donor-preloader");
      preloader.style.display = "block";
    });

  </script>
@endsection
