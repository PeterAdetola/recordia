@extends('admin.admin_master')
 @section('admin')
@php
$pageTitle = 'User Profile';

@endphp
    <div id="main">
      <div class="row">
        <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
        <div class="breadcrumbs-dark pb-0" id="breadcrumbs-wrapper">
          <!-- Search for small screen-->
          <div class="container">
            <div class="row">
              <div class="col s10 m6 l6">
                <!-- <h5 class="breadcrumbs-title mt-0 mb-0"><span>{{ $pageTitle }}</span></h5> -->
                <ol class="breadcrumbs mb-0">
                  <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Admin Home</a>
                  </li>
                  <li class="breadcrumb-item active">{{ $pageTitle }}
                  </li>
                </ol>
              </div>
          </div>
        </div>
        </div><br>
        <div class="col s12">
          <div class="container">

            <section class="tabs-vertical mt-1 section">
              <div class="row">
                <div class="col l4 s12">
                    @include('admin.profile.partials.profile-navigation')
                </div>
                <div class="col l8 s12">
                  <!-- tabs content -->
                    @include('admin.profile.partials.update-profile-information-form')
                    @include('admin.profile.partials.update-password-form')
                    @include('admin.profile.partials.delete-user-form')            
                </div>
              </div>
            </section>

        </div>       
    </div>
</div>
</div>
<script>
//     function dismissModal() {
//   var modal = document.getElementById("delete-modal");
//   modal.style.display = "none";
// }

// document.getElementById("cancelBtn").onclick = dismissModal;


</script>
@endsection