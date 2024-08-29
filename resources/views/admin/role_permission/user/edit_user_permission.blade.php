@extends('admin.admin_master')
 @section('admin')
  @section('vendor_styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/vendors/data-tables/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/vendors/data-tables/extensions/responsive/css/responsive.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/vendors/data-tables/css/select.dataTables.min.css') }}">
  @endsection
  @section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/pages/page-users.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/pages/form-select2.css') }}">
  @endsection

@php
$pageTitle = 'Edit User Permission';
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

            <!-- users edit start -->
<div class="section users-edit">
  <div class="card">
    <div class="card-content">
      <!-- <div class="card-body"> -->

            <h4 class="chip gradient-45deg-indigo-purple white-text ml-2 mb-3">Edit User Permission</h4>
      <!-- <div class="divider mb-3"></div> -->
            <div class="row">
        <div class="col s12" id="account">
              <!-- users edit media object start -->
                <div class="col s12 collection mb-5" style="padding: 2em;">
                  <div class="display-flex media">
                    <a href="#" class="avatar">

                          <div class="initial-avatar z-depth-4" style="border: solid whitesmoke 3px;">{{ $user->initials }}</div>
                    </a>
                    <div class="media-body">
                      <h6 class="media-heading col s12 m10">
                        <span class="ml-5 ">&nbsp;&nbsp;{{ $user->name }} </span>
                        <span class="grey-text">&nbsp;&nbsp;|&nbsp;&nbsp;</span>
                        <span class=" grey-text">{{ $user->username }}</span>
                      </h6>
                      <span class="ml-5">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $user->email }}</span>
                      <!-- <span class="users-view-id">305</span> -->
                    </div>
                  </div>
            </div>
            <!-- users edit media object ends -->
            <!-- users edit account form start -->
            <form action="{{ url('users/'.$user->id) }}" method="POST">
              <!-- <input type="hidden" name="id" valu /> -->
              @csrf
              @method('PUT')
                <div class="col s12">
                  <div class="row">
                    <div class="col s12 m6 input-field" style="padding-top: 2px;">
                  <div class="input-field">
                    <small>Role</small>
                    <select name="role[]" class="select2 browser-default" multiple="multiple">
  @if (count($roles) > 0)
    @foreach($roles as $role) 
                        <option value="{{ $role->name }}"
                          {{ in_array($role->name, $userRole) ? 'selected':'' }}
                          >{{ $role->name }}</option>
    @endforeach
  @else
                        <option value="">No role yet</option>
  @endif
                    </select>
                  </div>
                    </div>
                    <div class="col s12 m6 input-field mt-6">
                      <select name="status">
                        <option value="{{ ($user->status == 1) ? 1 : 0 }}">{{ ($user->status == 1) ? 'active':'inactive' }}</option>
                        <option value="1">active</option>
                        <option value="0">inactive</option>
                      </select>
                      <label>Status</label>
                    </div>
                  </div>
                </div>
      <div class="progress collection">
        <div id="update_user-preloader" class="indeterminate"  style="display:none; 
        border:2px #ebebeb solid"></div>
      </div>
                <div class="col s12 display-flex justify-content-end mt-3">
                  <button id="updateUserBtn" type="submit" class="btn-large">
                    Save</button>
                </div>
              </div>
            </form>
          <!-- users edit account form ends -->
        </div>
      </div>
      <!-- </div> -->
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
    <script src="{{ asset('backend/assets/vendors/select2/select2.full.min.js') }}"></script>
    <script src="{{ asset('backend/assets/vendors/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('backend/assets/vendors/data-tables/js/dataTables.select.min.js') }}"></script>
  @endsection
@section('scripts')
  <script src="{{ asset('backend/assets/js/scripts/page-users.js') }}"></script>
  <script src="{{ asset('backend/assets/js/scripts/form-select2.js') }}"></script>

  <script>

    document.getElementById("updateUserBtn").addEventListener("click", function() {
      var preloader = document.getElementById("update_user-preloader");
      preloader.style.display = "block";
    });

  </script>
@endsection
