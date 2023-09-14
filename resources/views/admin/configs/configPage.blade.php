@extends('admin.admin_master')
  @section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/pages/page-account-settings.css') }}">
  @endsection
 @section('admin')
@php
$pageTitle = 'Configuration Page';

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
                    @include('admin.configs.partials.config_navigation')
                </div>
                <div class="col l8 s12">
                  <!-- tabs content -->
                    @include('admin.configs.partials.create_year')           
                    @include('admin.configs.partials.activate_year')           
                    @include('admin.configs.partials.edit_year')           
                    @include('admin.configs.partials.events')           
                </div>
              </div>
            </section>

        </div>       
    </div>
</div>
</div>

@endsection
@section('scripts')
  <!-- <script src="{{ asset('backend/assets/js/scripts/page-users.js') }}"></script> -->
  <script src="{{ asset('backend/assets/js/scripts/page-account-settings.js') }}"></script>

  <script type="text/javascript">
    var radioButtons = document.querySelectorAll('input[type="radio"]');
    var submitButton = document.getElementById('activate');

    radioButtons.forEach(function(radioButton) {
      radioButton.addEventListener('change', function() {
        if (radioButton.checked) {
          submitButton.removeAttribute('disabled');
        } else {
          submitButton.setAttribute('disabled', 'disabled');
        }
      });
    });


  </script>
@endsection