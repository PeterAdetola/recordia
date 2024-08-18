
@extends('admin.admin_master')
@section('admin')
@php
$pageTitle = 'Assign Permissions';
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
                  <li class="breadcrumb-item"><a href="{{ route('view.roles') }}">View Roles</a>
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
         <div class="card">
            <div class="card-content pb-2">
               <h4 class="card-title mb-0">Assign permission for {{ $role->name }}</h4>
               <div class="divider mt-2"></div>
              <!-- <div class="col s12"> -->
                <form method="POST" action="{{ url('role/'.$role->id.'/update_permission') }}">
                  @csrf
                  @method('PUT')
                <table class="mt-1">
                  <thead>
                    <tr>
                      <th>Module Permission</th>
                      <th>Create</th>
                      <th>View</th>
                      <th>Edit</th>
                      <th>Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                   

                    @foreach($modules as $module)
                    @php 
                    $module = $module->name; 
                    $permission = $permissions->where('name', 'create_user')->first();
                    @endphp
                    <tr>
                      <td>{{ ucfirst($module) }}</td>
                      <td>
                        <label>
                          <input  class="filled-in" type="checkbox" 
                          name="permission[]"
                        @if($permissions->contains('name', 'create '.$module))
                          value="{{ $permissions->firstWhere('name', 'create '.$module)->name}}"  
                        @endif
          <?php  
  $permission = $permissions->firstWhere('name', 'create '.$module);

  if(!is_null($permission)) {
    $id = $permission->id;
  } else {
    $id = ''; 
  }?>
          {{ $permissions->contains('name','create '.$module) ? '' : 'disabled' }}
          {{ in_array($id, $rolePermissions) ? 'checked' : '' }}
                          />
                          <span>
                            <!-- create -->
                          </span>
                        </label>
                      </td>
                      <td>
                        <label>
                          <input  class="filled-in" type="checkbox" 
                          name="permission[]"
                        @if($permissions->contains('name', 'view '.$module))
                          value="{{ $permissions->firstWhere('name', 'view '.$module)->name}}"  
                        @endif        <?php  
  $permission = $permissions->firstWhere('name', 'view '.$module);

  if(!is_null($permission)) {
    $id = $permission->id;
  } else {
    $id = ''; 
  }?>
          {{ $permissions->contains('name','view '.$module) ? '' : 'disabled' }}
          {{ in_array($id, $rolePermissions) ? 'checked' : '' }}
                          />
                          
                          <span>
                            <!-- view -->
                          </span>
                        </label>
                      </td>
                      <td>
                        <label>
                          <input  class="filled-in" type="checkbox" 
                          name="permission[]"
                          
                        @if($permissions->contains('name', 'edit '.$module))
                          value="{{ $permissions->firstWhere('name', 'edit '.$module)->name}}"  
                        @endif
                 <?php  
  $permission = $permissions->firstWhere('name', 'edit '.$module);

  if(!is_null($permission)) {
    $id = $permission->id;
  } else {
    $id = ''; 
  }?>
          {{ $permissions->contains('name','edit '.$module) ? '' : 'disabled' }}
          {{ in_array($id, $rolePermissions) ? 'checked' : '' }}
                          />
                          
                          <span>
                            <!-- edit -->
                          </span>
                        </label>
                      </td>
                      <td>
                        <label>
                          <input  class="filled-in" type="checkbox" 
                          name="permission[]"
                        @if($permissions->contains('name', 'delete '.$module))
                          value="{{ $permissions->firstWhere('name', 'delete '.$module)->name}}"  
                        @endif
                  <?php  
  $permission = $permissions->firstWhere('name', 'delete '.$module);

  if(!is_null($permission)) {
    $id = $permission->id;
  } else {
    $id = ''; 
  }?>
          {{ $permissions->contains('name','delete '.$module) ? '' : 'disabled' }}
          {{ in_array($id, $rolePermissions) ? 'checked' : '' }}
                          />
                          
                          <span>
                            <!-- delete -->
                        </span>
                        </label>
                      </td>
                    </tr>
                    @endforeach
                    <tr>
                  </tbody>
                </table>
<div class="row">
      <div class="progress collection">
        <div id="assign_permission-preloader" class="indeterminate"  style="display:none; 
        border:2px #ebebeb solid"></div>
      </div>
        <button  id="assignPermissionBtn" type="submit" class="btn-large right">Save</button>
      </div>
              </form>
                <!-- </div> -->
              <!-- </div> -->
            </div>
            
         </div>


</div>




</div>
<!-- users view ends -->
          </div>
        </div>
      </div>
    </div>
    <!-- END: Page Main-->


<script>
    document.getElementById("assignPermissionBtn").addEventListener("click", function() {
      var preloader = document.getElementById("assign_permission-preloader");
      preloader.style.display = "block";
    });  
</script>



@endsection