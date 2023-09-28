<div>@extends('admin.admin_master')
 @section('admin')
  @section('vendor_styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/vendors/data-tables/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/vendors/data-tables/extensions/responsive/css/responsive.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/vendors/data-tables/css/select.dataTables.min.css') }}">
  @endsection
  @section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/pages/data-tables.css') }}">    
@livewireStyles
  @endsection
@php
$pageTitle = 'Instant Records';
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
                  <span>{{ $pageTitle }} for the year {{ getCurrentYear() }}</span>
                </h5>
                <ol class="breadcrumbs mb-0">
                  <li class="breadcrumb-item"><a  href="{{ route('dashboard') }}">Dashboard</a></li>
                  <li class="breadcrumb-item active">{{ $pageTitle }}</li>
                </ol>
              </div>
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
          <h4 class="card-title">Manage Records</h4>
          <div class="row">
            <div class="col s12">
              <p>The data in this table contains the extensive records of donations, pledges and expenses recorded so far, not for registered donors.</p>
            </div>
            <div class="col s12">
    @livewire('admin.records.instant-records-table')
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

              <!-- Content ends Here -->
            </div>

<div style="bottom: 50px; right: 19px;" class="fixed-action-btn direction-top"><a  wire:click="$set('modalOpen', true)" href="#add-donation-modal" class="btn-floating btn-large modal-trigger gradient-45deg-purple-deep-orange gradient-shadow"><i class="material-icons">add</i></a>
</div>
    @livewire('admin.records.modals.add-donation-form')
  </div>
          </div>
        </div>
      </div>
    </div>
    <!-- END: Page Main-->

@endsection
  @section('vendor_scripts')
    <script src="{{ asset('backend/assets/vendors/data-tables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/assets/vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('backend/assets/vendors/data-tables/js/dataTables.select.min.js') }}"></script>
  @endsection
@section('scripts')
@livewireScripts
  <!-- <script src="{{ asset('backend/assets/js/plugins.js') }}"></script> -->
  <script src="{{ asset('backend/assets/js/scripts/data-tables.js') }}"></script>
    <!-- <script src="{{ asset('backend/assets/js/custom/dashboard-script.js') }}"></script> -->
  <script type="text/javascript">
      // Preloader Script
      function ShowPreloader() {
        document.getElementById('preloader').style.display = "block";
      }


// Livewire component JavaScript code
const pledgeBtn = document.getElementById('pledge');
const radios = document.querySelectorAll('.payment_mode');
const phoneNumber = document.querySelector('#phoneNo');
const submitButton = document.getElementById('submitBtn');
const message = document.querySelector('#message');

// Function to show/hide message
function toggleMessage(show) {
  if (show) {
    message.style.display = 'block';
  } else {
    message.style.display = 'none';
  }
}

function validateForm() {
  let isValid = true;

  // Check if specific radio is checked and phone empty
  if (pledgeBtn.checked && !phoneNumber.value) {
    isValid = false;
  }

  // Check if any other radio is checked
  radios.forEach(radio => {
    if (radio !== pledgeBtn && radio.checked) {
      isValid = true;
    }
  });

  // Toggle submit based on validity
  if (isValid) {
    submitButton.disabled = false;
  } else {
    submitButton.disabled = true;
  }

  // Toggle message
  toggleMessage(!isValid);

  // Trigger Livewire validation
  Livewire.emit('validateForm', isValid);
}

radios.forEach(radio => {
  radio.addEventListener('change', validateForm);
});

phoneNumber.addEventListener('input', validateForm);

// Add event listener to radio change
pledgeBtn.addEventListener('change', function () {
  // Check if radio is checked and phone is empty
  if (this.checked && !phoneNumber.value) {
    // Disable submit button
    submitButton.disabled = true;
    toggleMessage(true);
  } else {
    // Re-enable submit button
    submitButton.disabled = false;
    toggleMessage(false);
  }

  // Trigger Livewire validation
  Livewire.emit('validateForm', this.checked && phoneNumber.value);
});

// Add event listener to phone number input
phoneNumber.addEventListener('input', function () {
  // Check radio is checked and phone has value
  if (pledgeBtn.checked && this.value) {
    // Re-enable submit button
    submitButton.disabled = false;
    toggleMessage(false);
  } else if (pledgeBtn.checked && !this.value) {
    // Disable submit button
    submitButton.disabled = true;
    toggleMessage(true);
  }

  // Trigger Livewire validation
  Livewire.emit('validateForm', pledgeBtn.checked && this.value);
});




       @if(Session::has('message'))

        setTimeout(function () {
          var toastHTML = "<i class='material-icons' style='color:#616161'>radio_button_checked</i>&nbsp;{{ Session::get('message') }}";
          M.toast({html: toastHTML})
        }, 500);

       @endif 

                
     document.addEventListener('livewire:initialized', () => {
       Livewire.on('addDonation', (event) => {
          Livewire.dispatch('refreshTable');
        // Close the modal
        $('.modal').modal('close');        
        // Remove the backdrop
        $('.modal-overlay').remove();
       });
    });
  </script>
@endsection
</div>
