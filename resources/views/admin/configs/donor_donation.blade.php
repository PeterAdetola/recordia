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
$pageTitle = 'Donor\'s Donations';
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
                  <span>{{ $pageTitle }}</span>
                </h5>
                <ol class="breadcrumbs mb-0">
                  <li class="breadcrumb-item"><a  href="{{ route('manage.donor') }}">Manage Donors</a></li>
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
                
                @if (count($donorDonations) > 0)
      <div id="" class="card card card-default scrollspy">
        <div class="card-content">
          <div class="row">
            <h4 class="card-title left ml-2">{{ $donor->title }} {{ $donor->name }}'s donations</h4>
            <a href="{{ route('activate.donors') }}"><span class="right chip"><b style="color: maroon;">&nbsp;Current Donations <i class="material-icons right mt-6" style="font-size: 1.2em;">navigate_next</i></b></span></a>
          </div>
          <div class="row">
            <div class="col s12">
              <p>All donations made by {{ $donor->title }} {{ $donor->name }}</p>
            </div>
            <div class="col s12">
              <table id="data-table-row-grouping" class="display">
                <thead>
                  <tr>
                    <th>Purpose</th>
                    <th>Amount</th>
                    <th>Payment Status</th>
                    <th>Verification</th>
                    <th>Recorder</th>
                    <th>Date</th>
                    <th>Year</th>
                    <th>Redeem</th>
                    <th>Event</th>
                  </tr>
                </thead>

                <tbody>

                @foreach ($donorDonations as $donorDonation) 


                  <tr>

                    <td  style="width: 10em;">{{ $donorDonation->purpose }}</td>

                    <td>{{ formatAmount($donorDonation->amount) }}</td>

                    @if($donorDonation->payment_status == 1)
                      <td><span class="chip green-text">paid</span></td>
                    @else
                      <td><span class="chip red-text">unpaid</span></td>
                    @endif

                    @if($donorDonation->verification == 1)
                      <td><i class="material-icons green-text">check_box</i></td>
                    @else
                      <td><i class="material-icons grey-text">indeterminate_check_box</i></td>
                    @endif
                    
                    <td>{{ $donorDonation['recorder']['name'] }}</td>

                    <td>{{ formatDate($donorDonation->updated_at) }}</td>

                    <td>{{ $donorDonation->year }}</td>

                  @if($donorDonation->payment_status == 1)
                    <td><a class="btn-floating mb-1 btn-flat waves-effect waves-light grey lighten-2">
                    <i class="material-icons">call_made</i>
                  </a></td>
                  @else
                    <td><a class="modal-trigger btn-floating mb-1 btn-flat waves-effect waves-light blue accent-2 white-text"  href="#{{ $donorDonation->id }}">
                    <i class="material-icons">call_received</i>
                  </a></td>
                  @endif

                    <td>{{ $donorDonation->event->name }}</td>

                  </tr>

        <!-- Table Modal here -->

    @include('admin.records.registered.modals.redeem-donation-form')

        <!-- /Donation info ends -->
                @endforeach

                </tbody>

                <tfoot>
                  <tr>
                    <th>Purpose</th>
                    <th>Amount</th>
                    <th>Payment Status</th>
                    <th>Verification</th>
                    <th>Recorder</th>
                    <th>Date</th>
                    <th>Year</th>
                    <th>Redeem</th>
                    <th>Event</th>
                  </tr>
                </tfoot>
              </table>
                @else
                <div class="card">
                  <div class="card-content row">
                    <h4 class="card-title center" style="margin: 3em; color: #757575">No record for {{ $donor->title }} {{ $donor->name }} yet</h4>
                  </div>
                </div>
                @endif

              
            </div>
          </div>
        </div>
      </div>
      
    <div class="card">
        <div class="card-content row">
          <h4 class="card-title">Donation Summary</h4>
          <div class="col s12 m6 collection" style="padding: 1.65em;">
            <p>Total Donation</p>
            <h5 style="color: #757575">&#8358;{{ $sumDonorDonations }}</h5>
          </div>
          <div class="col s12 m6 collection">
            <div class="collection-item" style="padding: 1.2em;">Total Payment&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp; &#8358; {{$paidDonorDonations}}</div>
            <div class="collection-item" style="padding: 1.2em;">
              Total OutStanding&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;&#8358; 
             {{$unpaidDonorDonations}}
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