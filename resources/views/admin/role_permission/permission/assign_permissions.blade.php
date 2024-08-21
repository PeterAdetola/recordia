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
<style>
  .embossed {
    text-shadow: 2px 2px 2px white;
  }
  .border {
    border: 1px #fafafa solid;
  }
  .collection {
    background-color: #fafafa;
  }
</style>
@endsection

<div id="main">
  <div class="row">
    <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
    <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
      <div class="container">
        <div class="row">
          <div class="col s10 m6 l6">
            <h5 class="breadcrumbs-title mt-0 mb-0"><span>{{ $pageTitle }}</span></h5>
            <ol class="breadcrumbs mb-0">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Admin Home</a></li>
              <li class="breadcrumb-item"><a href="{{ route('view.roles') }}">View Roles</a></li>
              <li class="breadcrumb-item active">{{ $pageTitle }}</li>
            </ol>
          </div>
        </div>
      </div>
    </div><br>

    <div class="col s12">
      <div class="container">
        <div class="row">
          <div class="col s12 m12 l8 mb-10">
            <div class="card">
              <div class="card-content pb-2">
                <h4 class="card-title mb-0"><span class="chip gradient-45deg-indigo-purple lighten-2 white-text text-accent-2">{{ ucfirst($role->name) }}</span></h4>
                <div class="divider mt-2"></div>

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
                      $moduleName = $module->name;
                      @endphp
                      <tr>
                        <td>{{ ucfirst($moduleName) }}</td>
                        @foreach(['create', 'view', 'edit', 'delete'] as $action)
                        @php
                        $permission = $permissions->firstWhere('name', $action.' '.$moduleName);
                        $id = $permission ? $permission->id : '';
                        @endphp
                        <td>
                          <label>
                            <input class="filled-in" type="checkbox" name="permission[]"
                              value="{{ $permission ? $permission->name : '' }}"
                              {{ $permission ? '' : 'disabled' }}
                              {{ in_array($id, $rolePermissions) ? 'checked' : '' }} />
                            <span></span>
                          </label>
                        </td>
                        @endforeach
                      </tr>
                      @endforeach
                    </tbody>
                  </table>

                  <div class="row">
                    <div class="progress collection">
                      <div id="assign_permission-preloader" class="indeterminate" style="display:none; border:2px #ebebeb solid"></div>
                    </div>
                    <button id="assignPermissionBtn" type="submit" class="btn-large right">Save</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  document.getElementById("assignPermissionBtn").addEventListener("click", function() {
    var preloader = document.getElementById("assign_permission-preloader");
    preloader.style.display = "block";
  });
</script>

@endsection