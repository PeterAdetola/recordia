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
$pageTitle = 'View User Details';
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
                  <li class="breadcrumb-item"><a  href="{{ route('view.users') }}">View Users</a></li>
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

            <!-- users view start -->
<div class="section users-view">
  <!-- users view media object start -->
  <div class="card-panel">
    <div class="row">
      <div class="col s12 m7">
        <div class="display-flex media">
          <a href="#" class="avatar">
            <!-- <img src="{{ asset('backend/assets/images/avatar/avatar-15.png') }}" alt="users view avatar" class="z-depth-4 circle"
              height="64" width="64"> -->

                <div class="initial-avatar z-depth-4">{{ getUserInitial() }}</div>
          </a>
          <div class="media-body">
            <h6 class="media-heading">
              <span class="users-view-name">&nbsp;&nbsp;Dean Stanley </span>
              <span class="grey-text">&nbsp;&nbsp;|&nbsp;&nbsp;</span>
              <span class="users-view-username grey-text">candy007</span>
            </h6>
            <span>&nbsp;&nbsp;ID:</span>
            <span class="users-view-id">305</span>
          </div>
        </div>
      </div>
      <div class="col s12 m5 quick-action-btns display-flex justify-content-end align-items-center pt-2">
        
<a href="{{ route('edit.user_details') }}" class="right ml-2" style="display: flex; align-items: center; "><span class="chip mr-0" style="margin-top: 5px;">Edit User</span><i class="small-ico-bg material-icons gradient-45deg-indigo-purple white-text mb-0">arrow_forward</i></a>
      </div>
    </div>
  </div>
  <!-- users view media object ends -->
  <!-- users view card data start -->
  <div class="card">
    <div class="card-content">
      <div class="row">
        <div class="col s12 m4">
          <table class="striped">
            <tbody>
              <tr>
                <td>Registered:</td>
                <td>01/01/2019</td>
              </tr>
              <tr>
                <td>Latest Activity:</td>
                <td class="users-view-latest-activity">30/04/2019</td>
              </tr>
              <tr>
                <td>Verified:</td>
                <td class="users-view-verified">Yes</td>
              </tr>
              <tr>
                <td>Role:</td>
                <td class="users-view-role">Staff</td>
              </tr>
              <tr>
                <td>Status:</td>
                <td><span class=" users-view-status chip green lighten-5 green-text">Active</span></td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="col s12 m8">
          <table class="responsive-table">
            <thead>
              <tr>
                <th>Module Permission</th>
                <th>Read</th>
                <th>Write</th>
                <th>Create</th>
                <th>Delete</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Users</td>
                <td>Yes</td>
                <td>No</td>
                <td>No</td>
                <td>Yes</td>
              </tr>
              <tr>
                <td>Articles</td>
                <td>No</td>
                <td>Yes</td>
                <td>No</td>
                <td>Yes</td>
              </tr>
              <tr>
                <td>Staff</td>
                <td>Yes</td>
                <td>Yes</td>
                <td>No</td>
                <td>No</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <!-- users view card data ends -->


</div>

              <!-- Content ends Here -->
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- END: Page Main-->

 <!--  <div style="bottom: 50px; right: 19px;" class="fixed-action-btn"><a href="#add-donor-modal" class="modal-trigger btn-floating btn-large gradient-45deg-purple-deep-orange gradient-shadow"><i class="material-icons">add</i></a>
  </div> -->

    <!-- Add Modal Here -->
    @include('admin.dashboard.modals.add-donor-form')

@endsection
  @section('vendor_scripts')
    <script src="{{ asset('backend/assets/vendors/data-tables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/assets/vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('backend/assets/vendors/data-tables/js/dataTables.select.min.js') }}"></script>
  @endsection
@section('scripts')
  <script src="{{ asset('backend/assets/js/scripts/data-tables.js') }}"></script>

  <script>

    document.getElementById("submitDonorBtn").addEventListener("click", function() {
      var preloader = document.getElementById("donor-preloader");
      preloader.style.display = "block";
    });

  </script>
@endsection
