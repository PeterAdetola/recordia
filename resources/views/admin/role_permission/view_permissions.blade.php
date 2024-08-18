
@extends('admin.admin_master')
@section('admin')
@php
$pageTitle = 'View Permissions';
@endphp

@section('headScript')
<script src="{{ asset('backend/assets/vendors/sortable/sortable.js') }}"></script>
@endsection

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/vendors/dropify/css/dropify.min.css') }}">
@endsection

    <style>
      .embossed{
        text-shadow: 2px 2px 2px white;
      }
      .border{
        border: 1px #fafafa solid;
      }
      .collection{
        background-color: #fafafa;
      }
    </style>

 <!-- BEGIN: Page Main-->
    <div id="main">
      <div class="row">
        <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
        <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
          <!-- Search for small screen-->
          <div class="container">
            <div class="row">
              <div class="col s10 m6 l6">
                <h5 class="breadcrumbs-title mt-0 mb-0"><span>{{ $pageTitle }}</span></h5>
                <ol class="breadcrumbs mb-0">
                  <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Admin Home</a>
                  </li>
                  <li class="breadcrumb-item active">{{ $pageTitle }}
                  </li>
                </ol>
              </div>
              <div class="col s2 m6 l6"><a class="btn dropdown-settings waves-effect waves-light breadcrumbs-btn right" href="#!" data-target="dropdown1">Module<i class="material-icons hide-on-med-and-up">settings</i><i class="material-icons right">arrow_drop_down</i></a>
              <ul class="dropdown-content" id="dropdown1" tabindex="0">
                <li tabindex="0"><a class="modal-trigger grey-text text-darken-2" href="#add_module-modal">Add Module</a></li>
                <li class="divider" tabindex="-1"></li>
                <li tabindex="0"><a class="grey-text text-darken-2" href="{{  route('view.modules')}}">View Modules</a></li>
              </ul>
              </div>

<!-- Somethings removed here -->

            </div>
          </div>
        </div><br>
        <div class="col s12">
          <div class="container">
            <!-- users view start -->
<div class="row"> 
  <div class="col s12 m12 l8 mb-10">    
         <div class="card subscriber-list-card">
            <div class="card-content pb-1">
               <h4 class="card-title mb-0">Permissions</h4>
            </div>
            <table class="subscription-table responsive-table highlight">
               <thead>
                  <tr>
                  </tr>
               </thead>
               <tbody>
          
  @if (count($modules) > 0)
    @foreach($modules as $module) 
          <tr>
             <td style="padding-left: 2em"><strong>{{ ucfirst($module->name) }}</strong></td>
             <td class="left-align">
              <span class="collection" style="padding: 1em; border-radius: 50px;">
              @foreach ($module->permissions as $permission)
               <a href="#edit_permission-modal{{ $permission->id }}" class="modal-trigger" ><span class="chip gradient-45deg-indigo-purple lighten-2 white-text text-accent-2">{{ $permission->name; }}
             <input type="hidden" name="order[]" value="{{ $permission->id }}"></span></a>

              
      @include('admin.role_permission.modals.permission.edit_permission-modal')
      @include('admin.role_permission.modals.permission.delete_permission-modal')
              @endforeach
            </span>
             </td>
            <!--  <td class="right-align"><a href="#edit_permission-modal{{ $permission->id }}" class="modal-trigger" ><span class="chip pink lighten-5 pink-text text-accent-2">Edit</span></a></td>
             <td class="center-align"><a href="#delete_permission-modal{{ $permission->id }}" class="modal-trigger"><i class="material-icons  small-ico-bg red-text">delete</i></a></td> -->
          </tr>
    @endforeach
        @else
          <tr>
             <td>Permission name</td>
             <td>Value</td>
             <td><a href="#"><span class="chip pink lighten-5 pink-text text-accent-2">Edit</span></a></td>
             <td class="center-align"><a href="#"><i class="material-icons grey-text">delete</i></a></td>
          </tr>
        @endif
               </tbody>
            </table>
         </div>


 
      @include('admin.role_permission.modals.module.add_module-modal')
</div>



  <div style="bottom: 50px; right: 19px;" class="fixed-action-btn direction-top"><a href="#add_permission-modal" class="modal-trigger btn-floating btn-large gradient-45deg-purple-deep-orange gradient-shadow"><i class="material-icons">add</i></a>
  </div>


     @include('admin.role_permission.modals.permission.add_permission-modal')

</div>
<!-- users view ends -->
          </div>
        </div>
      </div>
    </div>
    <!-- END: Page Main-->





@endsection
@section('scripts')
    <script src="{{ asset('backend/assets/vendors/dropify/js/dropify.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/scripts/form-file-uploads.js') }}"></script> 
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
@endsection