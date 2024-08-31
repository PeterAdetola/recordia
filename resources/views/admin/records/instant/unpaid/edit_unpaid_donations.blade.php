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
$pageTitle = 'Unpaid Donations';
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
                <h5 class="breadcrumbs-title mt-0 mb-0"><span>{{ $pageTitle }} for the year {{getCurrentYear()}}</span></h5>
                <ol class="breadcrumbs mb-0">
                  <li class="breadcrumb-item"><a  href="{{ route('dashboard') }}">Dashboard</a>
                  </li>
                  <li class="breadcrumb-item"><a  href="{{ route('instant.unpaid.donations') }}">{{ $pageTitle }}</a>
                  </li>
                  <li class="breadcrumb-item active">Edit {{ $pageTitle }}
                  </li>
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
          <h4 class="card-title">Unpaid Donations</h4>
          <div class="row">
            <div class="col s12">
              <p>The data in this table contains the records of pledges so far, for unregistered donors.</p>
            </div>
            <div class="col s12">
          <form id="redeemPledges" method="POST" action="{{ route('instant.redeem_pledges') }}">
          @csrf
              <table id="multi-select" class="display" style="height: 50px;">
                <thead>
                  <tr>
                     @if (count($unpaidDonations))
                    <th>
                      <label>
                        <input onchange="toggleCheckboxes(this)" id="headerCheckbox" type="checkbox" class="select-all"/>
                        <span></span>
                      </label>
                    </th>
                    @else
                    <th>
                      <label>
                        <input id="headerCheckbox" type="checkbox" class="select-all" disabled />
                        <span></span>
                      </label>
                    </th>
                    @endif
                    <th>Name</th>
                    <th>Purpose</th>
                    <th>Amount</th>
                    <th>Recorder</th>
                    <th>Payment Status</th>
                    <th>Verification</th>
                    <th>Phone</th>
                    <th>Date</th>
                  </tr>
                </thead>

                <tbody>
                @foreach ($unpaidDonations as $unpaidDonation)  
                  <tr>
                    <td>
                      <label>
                        <input type="checkbox" name="payment_status[]" value="{{ $unpaidDonation->id }}" class="data-checkbox" />
                        <span></span>
                      </label>
                    </td>
                    <td>{{ $unpaidDonation->name }}</td>
                    <td  style="width: 10em;">{{ $unpaidDonation->purpose }}</td>
                    <td>{{ formatAmount($unpaidDonation->amount) }}</td>
                    
                    <td>{{ $unpaidDonation['recorder']['name'] }}</td>

                    @if($unpaidDonation->payment_status == 1)
                    <td><span class="chip green-text">Paid</span></td>
                    @elseif($unpaidDonation->payment_status == 0 && $unpaidDonation->transaction == 0)
                    <td><span class="chip red-text">Paid</span></td>
                    @else
                    <td><span class="chip red-text">Unpaid</span></td>
                    @endif

                    @if($unpaidDonation->verification == 1)
                      <td><i class="material-icons green-text">check_box</i></td>
                    @else
                      <td><i class="material-icons grey-text">indeterminate_check_box</i></td>
                    @endif

                    <td>{{ $unpaidDonation->phone }}</td>
                    <td>{{ formatDate($unpaidDonation->updated_at) }}</td>
                  </tr>
                @endforeach
                </tbody>

                <!-- <tfoot>
                  <tr>
                    <th>Name</th>
                    <th>Purpose</th>
                    <th>Amount</th>
                    <th>Transaction</th>
                    <th>Payment Status</th>
                    <th>Verification</th>
                    <th>Phone</th>
                    <th>Date</th>
                  </tr>
                </tfoot> -->
              </table>
<!-- Modal Structure -->

    <div id="verify-donation-modal" class="modal border-radius-10" style="padding:2em;">
        <div class="modal-content">
          <h6 class="card-title">You are about to redeem <span id="checkbox-count">0</span></h6>

        <p>Do you want to proceed?</p>
        </div>

      <div class="progress collection">
        <div id="preloader" class="indeterminate" style="display:none; 
        border:2px #ebebeb solid"></div>
      </div>

        <div class="modal-footer">
          <button type="submit" onclick="ShowPreloader()" class="modal-action waves-effect waves-green btn-large">Yes, Redeem</button>
          <a id="reload2" href="javascript:void(0)" class="btn-large btn-flat modal-close">No, Cancel</a>
        </div>
    </div>

          </form>
              <div class="row">
                <button id="submitBtn" href="#verify-donation-modal" disabled class="btn mt-1 ml-1 modal-trigger">Redeem Pledges<i class="material-icons left">check_circle</i> </button>
                <span class="mt-2 mr-4 right">Total&nbsp;&nbsp;&nbsp;&nbsp; <span style="font-weight: 800;">&#8358;&nbsp;&nbsp;{{ sumAllInstantPledges() }}</span></span>
              </div>
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

@endsection
  @section('vendor_scripts')
    <script src="{{ asset('backend/assets/vendors/data-tables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/assets/vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('backend/assets/vendors/data-tables/js/dataTables.select.min.js') }}"></script>
  @endsection
@section('scripts')
  <!-- <script src="{{ asset('backend/assets/js/plugins.js') }}"></script> -->
  <script src="{{ asset('backend/assets/js/scripts/data-tables.js') }}"></script>

  <script type="text/javascript">



/**
 *  Multiselect checkboxes
 */

  var table = document.getElementById('multi-select');
  var headerCheckbox = table.querySelector('thead input[type="checkbox"]');
  var checkboxes = table.querySelectorAll('tbody input[type="checkbox"]');

  headerCheckbox.addEventListener('change', function() {
    checkboxes.forEach(function(checkbox) {
      checkbox.checked = headerCheckbox.checked;
    });
  });



/**
 *  Validate checkbox submit
 */

const checkboxes2 = document.querySelectorAll('table input[type="checkbox"]');
const submitBtn = document.getElementById('submitBtn');
// const submitBtn2 = document.getElementById('submitBtn2');

checkboxes2.forEach(function (checkbox) {
    checkbox.addEventListener('change', function () {
        const checkedCheckboxes = document.querySelectorAll('table input[type="checkbox"]:checked');
        submitBtn.disabled = checkedCheckboxes.length === 0;
        // submitBtn2.disabled = checkedCheckboxes.length === 0;
    });
});



/**
 *  Determine amount to verify
 */

$(document).ready(function() {
  $('#submitBtn').click(function(e) {
    
    // Count the total number of checkboxes in the table
    var totalCheckboxes = $('input.data-checkbox').length;

    // Count the checked checkboxes
    var checkedCheckboxes = $('input.data-checkbox:checked').length;

     // Determine the state based on the counts
    var state;
    if (checkedCheckboxes === 1) {
      state = "a pledge";
    } else if (checkedCheckboxes === totalCheckboxes) {
      state = "all pledges";
    } else {
      var count = $('input.data-checkbox:checked').length;
      state = count+' pledges';
    }
    
    // Display the count
    $('#checkbox-count').text(state);

  });
});


      function ShowPreloader() {
        document.getElementById('preloader').style.display = "block";
      }

  </script>
@endsection