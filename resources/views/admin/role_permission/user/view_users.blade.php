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
$pageTitle = 'View Users';
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
    
  <div class="users-list-table">
      <div id="" class="card card-default scrollspy">
        <div class="card-content">
          <div class="row">
            <!-- <h4 class="card-title left ml-2">{{-- $pageTitle --}}</h4> -->
            <h4 class="chip gradient-45deg-indigo-purple white-text ml-2">{{ $pageTitle }}</h4>
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
                    <th>Username</th>
                    <th>Name</th>
                    <th>Last Activity</th>
                    <th>Verified</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Edit</th>
                    <th>View</th>
                  </tr>
                </thead>

                <tbody>
    @if(count($users) > 0)
        @foreach($users as $user)
              <tr>
                <td>{{ $user->username }}</td>
                <td>{{ $user->name }}</td>
                <td>03/01/2020</td>
                <td>{{ $user->email_verified_at ? 'Yes' : 'No' }}</td>
                <td>
                  @if(!empty($user->getRoleNames()))
                  @foreach($user->getRoleNames() as $rolename)
                      <span class="chip">{{ $rolename }}</span>
                  @endforeach
                  @endif
                  <!-- <span class="chip">User</span><span class="chip">Admin</span><span class="chip">Chief-admin</span>  -->
                </td>
                <td>
                  <span class="chip {{ $user->status == 1 ? 'green':'grey' }} lighten-{{ $user->status == 1 ? 5:3 }}">
                    <span class="{{ $user->status == 1 ? 'green-text':'grey-text' }}">
                      {{ $user->status == 1 ? 'active':'inactive' }}
                    </span>
                  </span>
                </td>
                <!-- <td><a href="{{ url('user/'.$user->id.'/edit') }}"><i class="material-icons">edit</i></a></td> -->
                <td><a href="{{ route('edit.user_permission', $user->id) }}"><i class="material-icons">edit</i></a></td>
                <td><a href="{{ route('view.user_details') }}"><i class="material-icons">remove_red_eye</i></a></td>
              </tr>
        @endforeach
    @else
              <tr>
                <td><a href="page-users-view.html">hillary1807</a>
                </td>
                <td>Firstname Surname</td>
                <td>18/07/2019</td>
                <td>No</td>
                <td>Role</td>
                <td><span class="chip red lighten-5"><span class="red-text">Status</span></span></td>
                <td><a href="#!"><i class="material-icons">edit</i></a></td>
                <td><a href="page-users-view.html"><i class="material-icons">remove_red_eye</i></a></td>
              </tr>
  @endif
                </tbody>

                <tfoot>
                  <tr>
                    <th>Username</th>
                    <th>Name</th>
                    <th>Last Activity</th>
                    <th>Verified</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Edit</th>
                    <th>View</th>
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
