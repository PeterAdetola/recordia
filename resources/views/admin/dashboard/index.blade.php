 @extends('admin.admin_master')
  @section('vendor_styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/vendors/data-tables/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/vendors/data-tables/extensions/responsive/css/responsive.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/vendors/data-tables/css/select.dataTables.min.css') }}">
  @endsection
  @section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/pages/data-tables.css') }}">
  @endsection
 @section('admin')
    <!-- BEGIN: Page Main-->
    <div id="main">
      <div class="row">
        <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
        <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
          <!-- Search for small screen-->
          <div class="container">
            <div class="row">
              <div class="col s10 m6 l6">
                <h5 class="breadcrumbs-title mt-0 mb-0"><span>Hi, {{ getUserName() }}</span></h5>
                <ol class="breadcrumbs mb-0">
                  <li class="breadcrumb-item"><a href="#!">Here is 
                  @role('admin') the @endrole 
                  @role('recorder') your @endrole
                financial overview/activities for the year {{ getCurrentYear() }}</a>
                  </li>
                </ol>
              </div>

            </div>
          </div>
        </div>
        <div class="col s12">
          <div class="container">
    <div class="section">
      <!-- Add Financial Overview Here -->
    @include('admin.dashboard.financial-overview')
    </div>

<div class="divider"></div>

    <div class="row">

      <a class="modal-trigger" href="#add-donation-modal">
      <div class="col s12 m6 l4 card-width">
        <div class="card border-radius-6">
          <div class="card-content center-align">
            <i class="material-icons green-text small-ico-bg mb-5">add_circle</i>
            <p class="green-text  mt-3">Add Donation</p>
          </div>
        </div>
      </div>
    </a>

    <!-- Add Modal Here -->
    @include('admin.dashboard.modals.add-donation-form')

      <a href="#!">
      <div class="col s12 m6 l4 card-width">
        <div class="card border-radius-6">
          <div class="card-content center-align">
            <i class="material-icons blue-text small-ico-bg mb-5">person_add</i>
            <p class="blue-text  mt-3">Register Donor</p>
          </div>
        </div>
      </div>
    </a>

    <!-- Add Modal Here -->

      @role('admin')
    <a class="modal-trigger" href="#add-expense-modal">
      <div class="col s12 m6 l4 card-width">
        <div class="card border-radius-6">
          <div class="card-content center-align">
            <i class="material-icons red-text small-ico-bg mb-5">add_circle</i>
            <p class="red-text  mt-3">Add Expense</p>
          </div>
        </div>
      </div>
    </a>
      @endrole

    <!-- Add Modal Here -->
    @include('admin.dashboard.modals.add-expense-form')

      
    </div>
<div class="divider"></div>

    <!-- Add Table Here -->
    <div class="section section-data-tables">
    @include('admin.dashboard.unverified-donation-table')
    </div>
      </div>
    </div>
  </div>
</section>


          </div>
          <!-- <div class="content-overlay"></div> -->
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
    <!-- <script src="{{ asset('backend/assets/js/scripts/data-tables.js') }}"></script> -->
    <script type="text/javascript">


// Initialize datatable
    $('#multi-select').DataTable({
    responsive: true,
    "paging": false,
    "ordering": false,
    "info": false,
    "columnDefs": [{
      "visible": false,
      "targets": 1
    }],
  });


// Multiselect checkboxes
  var table = document.getElementById('multi-select');
  var headerCheckbox = table.querySelector('thead input[type="checkbox"]');
  var checkboxes = table.querySelectorAll('tbody input[type="checkbox"]');

  headerCheckbox.addEventListener('change', function() {
    checkboxes.forEach(function(checkbox) {
      checkbox.checked = headerCheckbox.checked;
    });
  });


// Validate checkbox submit
const checkboxes2 = document.querySelectorAll('table input[type="checkbox"]');
const submitBtn = document.getElementById('submitBtn');
const submitBtn2 = document.getElementById('submitBtn2');

checkboxes2.forEach(function (checkbox) {
    checkbox.addEventListener('change', function () {
        const checkedCheckboxes = document.querySelectorAll('table input[type="checkbox"]:checked');
        submitBtn.disabled = checkedCheckboxes.length === 0;
        submitBtn2.disabled = checkedCheckboxes.length === 0;
    });
});


// Determine amount to verify
$(document).ready(function() {
  $('#submitBtn').click(function(e) {
    
    // Count the total number of checkboxes in the table
    var totalCheckboxes = $('input.data-checkbox').length;

    // Count the checked checkboxes
    var checkedCheckboxes = $('input.data-checkbox:checked').length;

     // Determine the state based on the counts
    var state;
    if (checkedCheckboxes === 1) {
      state = "a donor";
    } else if (checkedCheckboxes === totalCheckboxes) {
      state = "all donors";
    } else {
      var count = $('input.data-checkbox:checked').length;
      state = count+' donors';
    }
    
    // Display the count
    $('#checkbox-count').text(state);

  });
});


// Prevent pledge donation without phone number
const form = document.getElementById('donationForm');
const pledgeBtn = document.querySelector('input[name="payment_mode"][value="4"]'); 
const radios = document.querySelectorAll('input[name="payment_mode"]'); 
const phoneNumber = document.querySelector('#phone');
const submitButton = document.querySelector('button[type="submit"]');
const message = document.querySelector('#message');

// Function to show/hide message
function toggleMessage(show) {
  if(show) {
    message.style.display = 'block';
  } else {
    message.style.display = 'none'; 
  }
}

// ---------------------------------------
function validateForm() {

  let isValid = true;

  // Check if specific radio is checked and phone empty
  if(pledgeBtn.checked && !phoneNumber.value) {
    isValid = false;
  }

  // Check if any other radio is checked  
  radios.forEach(radio => {
    if(radio !== pledgeBtn && radio.checked) {
      isValid = true;
    }
  });

  // Toggle submit based on validity
  if(isValid) {
    submitButton.disabled = false;
  } else {
    submitButton.disabled = true; 
  }

  // Toggle message
  toggleMessage(!isValid);

}

radios.forEach(radio => {

  radio.addEventListener('change', validateForm);

});

phoneNumber.addEventListener('input', validateForm);

// ------------------------------------------

// Add event listener to radio change
pledgeBtn.addEventListener('change', function() {

  // Check if radio is checked and phone is empty
  if(this.checked && !phoneNumber.value) {

    // Disable submit button
    submitButton.disabled = true;
    toggleMessage(true);

  } else {

    // Re-enable submit button
    submitButton.disabled = false;
    toggleMessage(false);
  }

});

// Add event listener to phone number input
phoneNumber.addEventListener('input', function() {

  // Check radio is checked and phone has value  
  if(pledgeBtn.checked && this.value) {

    // Re-enable submit button
    submitButton.disabled = false;
    toggleMessage(false);

  } else if(pledgeBtn.checked && !this.value) {

    // Disable submit button  
    submitButton.disabled = true;
    toggleMessage(true);
  }

});
    </script>
  @endsection