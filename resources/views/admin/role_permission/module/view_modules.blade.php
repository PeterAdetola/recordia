
@extends('admin.admin_master')
@section('admin')
@php
$pageTitle = 'View Modules';
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
                <h5 class="breadcrumbs-title mt-0 mb-0"><span>{{ $pageTitle }}</span></h5>
                <ol class="breadcrumbs mb-0">
                  <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Admin Home</a>
                  </li>
                  <li class="breadcrumb-item"><a href="{{ route('view.permissions') }}">View Permissions</a>
                  </li>
                  <li class="breadcrumb-item active">{{ $pageTitle }}
                  </li>
                </ol>
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
            <div class="card-content pb-10">
               <h4 class="card-title mb-0">Modules</h4>
            <table class="subscription-table responsive-table highlight">
               <thead>
                  <tr>
                  </tr>
               </thead>
               <tbody>
          
  @if (count($modules) > 0)
    @foreach($modules as $module) 
          <tr>
             <td style="padding-left: 2em">{{ $module->name }}</td>
             <td class="right-align"><a href="#edit_module-modal{{ $module->id }}" class="modal-trigger" ><span class="chip pink lighten-5 pink-text text-accent-2">Edit</span></a></td>
             <td class="center-align"><a href="#delete_module-modal{{ $module->id }}" class="modal-trigger"><i class="material-icons  small-ico-bg red-text">delete</i></a></td>
             <input type="hidden" name="order[]" value="{{ $module->id }}">
          </tr>
      @include('admin.role_permission.module.modals.edit_module-modal')
      @include('admin.role_permission.module.modals.delete_module-modal')
    @endforeach
        @else
          <tr>
             <td style="padding-left: 2em">Module name</td>
             <td>Value</td>
             <td><a href="#"><span class="chip pink lighten-5 pink-text text-accent-2">Edit</span></a></td>
             <td class="center-align"><a href="#"><i class="material-icons grey-text">delete</i></a></td>
          </tr>
        @endif
               </tbody>
            </table>
            </div>
         </div>


</div>



  <div style="bottom: 50px; right: 19px;" class="fixed-action-btn direction-top"><a href="#add_module-modal" class="modal-trigger btn-floating btn-large gradient-45deg-purple-deep-orange gradient-shadow"><i class="material-icons">add</i></a>
  </div>


     @include('admin.role_permission.module.modals.add_module-modal')

</div>
<!-- users view ends -->
          </div>
        </div>
      </div>
    </div>
    <!-- END: Page Main-->





@endsection