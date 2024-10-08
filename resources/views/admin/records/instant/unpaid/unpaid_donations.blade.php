@extends('admin.admin_master')
 @section('admin')
  @section('vendor_styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/vendors/data-tables/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/vendors/data-tables/extensions/responsive/css/responsive.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/vendors/data-tables/css/select.dataTables.min.css') }}">
  @endsection
  @section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/pages/data-tables.css') }}">
    @include('admin.records.instant.modal_style')

  @endsection

<?php
$pageTitle = 'Unpaid Donations';$isRecorder = auth()->user()->hasRole('recorder');

if($isRecorder){
  $unpaidDonations = $unpaidDonations->where('recorder_id', '=', getCurrentUser());
}
?>


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
                  <li class="breadcrumb-item active">{{ $pageTitle }}
                  </li>
                </ol>
              </div>
              @if(isAdmin())
              <div class="col s2 m6 l6"><a class="btn dropdown-settings waves-effect waves-light breadcrumbs-btn right" href="#!" data-target="dropdown1"><i class="material-icons hide-on-med-and-up">settings</i><i class="material-icons right">arrow_drop_down</i></a>
              <ul class="dropdown-content" id="dropdown1" tabindex="0">
                <li tabindex="0"><a class="grey-text text-darken-2" href="{{ route('instant.edit.pledges') }}">Redeem Pledges</a></li>
                <li class="divider" tabindex="-1"></li>
                <li tabindex="0"><a class="grey-text text-darken-2" href="{{  route('instant.prev_unpaid.donations')}}">Print</a></li>
              </ul>
              </div>
              @endif
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
              <table id="data-table-row-grouping" class="display">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Purpose</th>
                    <th>Amount</th>
                    <th>Recorder</th>
                    <th>Payment Status</th>
                    <th>Verification</th>
                    <th>Phone</th>
                    <th>Event</th>
                    <th>Date</th>
                    <th>Redeem</th>
                  </tr>
                </thead>

                <tbody>
                @foreach ($unpaidDonations as $unpaidDonation)  
                  <tr>
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
                    <td>{{ ($unpaidDonation->event == '')? 'No event': $unpaidDonation->event }}</td>
                    <td>{{ formatDate($unpaidDonation->updated_at) }}</td>
                    <td>
                      <a class="modal-trigger" href="#{{ $unpaidDonation->id }}" ><i class="material-icons red-text small-ico-bg">edit</i></a>
                    </td>
                  </tr>


<!-- Modal Structure -->

    <div id="{{ $unpaidDonation->id }}" class="modal border-radius-10" style="padding:2em;">

<form id="redeemPledge" method="POST" action="{{ route('instant.redeem_a_pledge') }}">
      @csrf
      <input type="hidden" name="id" value="{{ $unpaidDonation->id }}">
      <input type="hidden" name="payment_status" value="1">
        <div class="modal-content">
          <h6 class="card-title">
            You are about to confirm that the pledge of 
            {{ $unpaidDonation->name }} has been paid
          </h6>

        <p>Do you want to proceed ?</p>
        </div>
    <div class="progress collection">
      <div id="preloader{{$unpaidDonation->id}}" class="indeterminate"  style="display:none; 
      border:2px #ebebeb solid"></div>
    </div>

        <div class="modal-footer">
      <button id="submitBtn{{$unpaidDonation->id}}" type="submit" class="modal-action waves-effect waves-green btn-large" >Yes, Pledge is paid</button>
          <a href="javascript:void(0)" class="btn-large btn-flat modal-close">No, Cancel</a>
        </div>



<script type="text/javascript"> 
      // Preloader Script
document.getElementById("submitBtn{{$unpaidDonation->id}}").addEventListener("click", function() {
  var preloader = document.getElementById("preloader{{$unpaidDonation->id}}");
  preloader.style.display = "block";
});
</script>
    </div>
</form>
 

        <!-- /Donation info ends -->
                @endforeach
                </tbody>

                <tfoot>
                  <tr>
                    <th>Name</th>
                    <th>Purpose</th>
                    <th>Amount</th>
                    <th>Recorder</th>
                    <th>Payment Status</th>
                    <th>Verification</th>
                    <th>Phone</th>
                    <th>Event</th>
                    <th>Date</th>
                    <th>Redeem</th>
                  </tr>
                </tfoot>
              </table>
              <div class="divider"></div>
              <div class="row">
                @if(isAdmin())
                <div class="mt-2 mr-4 center">Total&nbsp;&nbsp;&nbsp;&nbsp; <span style="font-weight: 800;">&#8358;&nbsp;&nbsp;{{ sumAllInstantPledges() }}</span></div>
                @endif
              </div>
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


@endsection